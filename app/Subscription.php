<?php

namespace App;

use App\Events\SystemNoAssigned;
use App\Invoice;
use App\Mail\BillingFailedNotification;
use App\Mail\BillingNotification;
use App\Mail\SubscriptionRenewNotification;
use App\Mail\UnableToSetSystemNumber;
use App\Traits\Paystack;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    use Paystack;

    protected $guarded = [];
    protected $appends = ['durationSpent'];


    public function subscriber()
    {
        return $this->morphTo();
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function deactivate()
    {
        return $this->update([
            'active' => false,
            'subscription_end_at' => Carbon::now()
        ]);
    }

    public function setSystemNumber()
    {
        $adminUsers = User::whereAdmin(true)->get();
        $user = $this->owner;

        for ($i=1; $i < 16 ; $i++) { 
            $systemNo  = date('y') . '/' . date('n') . '/' . $i;
            if (!Subscription::where('system_no', $systemNo)->exists()) {
                $this->update([
                    'system_no' => $systemNo
                ]);  
                $owner      = $this->owner;
                $subscriber = $this->subscriber;

                event(new SystemNoAssigned($this, $owner, $subscriber));
                return true;
            }

        }

        Mail::to($adminUsers)->send(new UnableToSetSystemNumber($user));

    }

    public function scopeActiveSubscriptions()
    {
        return static::where('active', 1);
    }

    static public function deactivateDueSubscriptions()
    {
        $activeSubscriptions = static::activeSubscriptions()->get();
        foreach ($activeSubscriptions as $subscription) {
            if ($subscription->durationSpentInDays() > $subscription->durationInDays()) {
                $subscription->deactivate();
            }
        }
        return true;
    }

    static public function sendBillingNotificatoinMail()
    {
        $activeSubscriptions = static::activeSubscriptions()->where('recurring', true)->get();
        foreach ($activeSubscriptions as $subscription) {
            if ($subscription->durationInDays() - $subscription->durationSpentInDays() === 6) {
                Mail::to($subscription->owner)->send(new BillingNotification($subscription, $subscription->owner, $subscription->subscriber));
            }
        }
        return true;
    }

    static public function chargeRecurringSubscriptions()
    {
        $activeSubscriptions = static::activeSubscriptions()->where('recurring', true)->get();
        foreach ($activeSubscriptions as $subscription) {
            if ($subscription->subscriptionDaysLeft() == 3 || $subscription->subscriptionDaysLeft() <=1 ) {
                $subscription->chargeRenewFee();
            }
        }
        return true;
    }

    public function subscriptionDaysLeft()
    {
        return $this->durationInDays() - $this->durationSpentInDays();
    }

    public function chargeRenewFee()
    {
        $reference_num = rand(10*45, 100*98);
        $card = $this->owner->debitCards()->latest()->first();

        $data = [
            "amount" => $this->subscriber->amount,
            "authorization_code" => $card->authorization_code,
            "email" => $this->owner->email,
            "metadata" => [
                'purpose' => 'Subscription Renewal',
                'method' => 'DebitCard - ' . $card->authorization_code,
            ],
        ];

        $url = "https://api.paystack.co/transaction/charge_authorization";

        $fields_string = http_build_query($data);

        $responds = $this->makePaystackRequest($url, $fields_string);
        if (isset($responds['data'])) {
            if ($responds['data']['status'] === 'success') {

                $this->invoice->recordPayment($responds['data']);

                $this->extendDuration();

                Mail::to($this->owner)->send(new SubscriptionRenewNotification($this, $this->owner, $this->subscriber));
                return true;
            }
            Mail::to($this->owner)->send(new BillingFailedNotification($this, $this->owner, $this->subscriber));
        }
    }



    public function extendDuration()
    {
        $this->duration += 4;
        $this->save();

        return true;
    }

    public function durationSpentInDays()
    {
        return $this->created_at->diffInDays();
    }

    public function durationInDays()
    {
        return $this->duration * 7;
    }

    public function durationSpent($subscription = null)
    {
        if (!empty($subscription)) {
            return $subscription->created_at->diffInWeeks();
        }
        return $this->created_at->diffInWeeks();
    }

    public function getDurationSpentAttribute()
    {
        return $this->durationSpent();
    }

    public function status($subscription = null)
    {
        if (!empty($subscription)) {
            return !! $subscription->active;
        }
        return !! $this->active;
    }

    public function isSubscribeToClass($subscription = null)
    {
        if (!empty($subscription)) {
            return !! $subscription->class;
        }
        return !! $this->class;   
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function endsAt()
    {
        return Carbon::parse($this->created_at->addWeeks($this->duration))->toDayDateTimeString();
    }

    public function startsAt()
    {
        return Carbon::parse($this->created_at)->toDayDateTimeString();
    }

    public function getEndsAtAttribute()
    {
        return $this->endsAt();
    }

    static public function countActiveSub()
    {
        return self::where('active', true)->count();
    }

    public function platform()
    {
        return $this->class ? 'Classroom' : 'Online';
    }
}
