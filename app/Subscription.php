<?php

namespace App;

use App\Events\SystemNoAssigned;
use App\Mail\UnableToSetSystemNumber;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    protected $guarded = [];


    public function subscriber()
    {
        return $this->morphTo();
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
            if ((new self)->durationSpent($subscription) >= $subscription->duration) {
                $subscription->deactivate();
            }
        }
        return true;
    }

    public function durationSpent($subscription = null)
    {
        if (!empty($subscription)) {
            return $subscription->created_at->diffInMonths();
        }
        return $this->created_at->diffInMonths();
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
}
