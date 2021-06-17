<?php

namespace App;

use App\Events\SystemNoAssigned;
use App\Events\UserSubscribedToCourse;
use Carbon\Carbon;

trait Subscriber
{
    public function subscriptions()
    {
        return $this->morphMany('App\Subscription', 'subscriber');
    }

        // App\Course::WhereSubscribeBy(App\User::find(2))->get();
    //    get all courses with a subscriptions by this user
    public function scopeWhereSubscribeBy($query, User $user)
    {
        return $query->whereHas('subscriptions', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

    //    to create subscription for a user in a particular module e.g. $course->createSubscription(1);
    public function createSubscription($userId = null, $invoice_id = null, $class = null, $duration = null)
    {
        $duration = $duration ? $duration : $this->duration;

        if (! $this->hasActiveSubscription()){
            $subscription = $this->subscriptions()->save(
                    new Subscription([
                        'user_id'       => $userId ?: auth()->id(),
                        'duration'      => $duration,
                        'invoice_id'    => $invoice_id,
                        'class'         => $class,  
                        'recurring'     => $class === true ? false : true,
                    ])
            );
            if ($class) {
                $subscription->setSystemNumber();
            }

            UserSubscribedToCourse::dispatch($user = $userId ?: auth()->id());

            return $subscription;

        };
    }

    //    to deactivate invoice for a user in a particular module e.g. $course->createSubscription(1);
    public function deactivateSubscription($userId = null)
    {
        $userId = $userId ?: auth()->id();

        $this->subscriptions()->where(['user_id' => auth()->id()])->update(['active' => false]);


        $this->subscriptions()->where(['user_id' => $userId])->update(
            [
                'active' => false,
                'subscription_end_at' => Carbon::now()
            ]
        );
        $this->save();
    }

    // check if this course is subscribe by this user.
    public function isSubscribedBy(User $user)
    {
        if (
            $this->subscriptions()
            ->where(['user_id' => $user->id, 'active' => true])
            ->exists()
        ) {return true;}
        $activeParentCourses = $this->parentCourse()->get()->map(function($course) use($user){
            return $course->subscriptions()->where(['user_id' => $user->id, 'active' => true])->pluck('id');
        });

        if ($activeParentCourses->isNotEmpty()) {
            return true;
        }
        return false;
    }

    public function getIsSubscribedByAttribute()
    {
        if (auth()->user()) {
            return $this->isSubscribedBy(auth()->user());
        }
        return false;
    }
    // hello world

    // Return a subscription for this course by this user
    public function getSubscriptionsBy(User $user)
    {
        return $this->subscriptions()
            ->where(['user_id' => $user->id]);
    }
}