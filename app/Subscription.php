<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = [];

//    protected $with = ['courses'];

   // public function courses()
   // {
   //     return $this->belongsTo(Course::class, 'subscriber_id');
   // }
//
//    public function activate($subscription = null)
//    {
//        if ($subscription) {
//            return $subscription->update([
//                'active' => true,
//            ]);
//        }
//        return $this->update([
//            'active' => true,
//        ]);
//    }
//
//

    public function deactivate()
    {
        return $this->update([
            'active' => false,
            'subscription_end_at' => Carbon::now()
        ]);
    }
//
//    static public function activeSubscriptions()
//    {
//        return static::where('active', 1);
//    }
//
//    static public function activeClassRoomStudents()
//    {
//        return static::where('active', 1)
//            ->where('class', true);
//    }

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
}
