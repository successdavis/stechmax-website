<?php

namespace App;

use App\User;
use Carbon\Carbon;
use App\Mail\PleaseConfirmYourEmail;
use App\Mail\UnableToSetSystemNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    protected $guarded = [];

    protected static function boot(){
        parent::boot();

        static::created(function ($subscription) {
            if ($subscription->class) {
                $subscription->setSystemNumber();
            }
        });
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
        for ($i=1; $i < 16 ; $i++) { 
            $systemNo  = date('n') . '/' . $i;
            if (!Subscription::where('system_no', $systemNo)->exists()) {
                $this->update([
                    'system_no' => $systemNo
                ]);
                return true;
            }

        }

        $adminUsers = User::whereAdmin(true)->get();
        $user = $this->owner();

        dd($this->subscriber);

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

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
