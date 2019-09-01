<?php

namespace App;

use Carbon\Carbon;

trait Subscriber
{
    public function subscriptions()
    {
        return $this->morphMany(Subscription::class, 'subscriber');
    }

    //    get all courses with a subscriptions by this user
    public function scopeWhereSubscribeBy($query, User $user)
    {
        return $query->whereHas('subscriptions', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

    //    to create subscription for a user in a particular module e.g. $course->createSubscription(1);
    public function createSubscription($userId = null, $invoice_id = null)
    {
        if (! $this->subscriptions()->where(['user_id' => auth()->id(), 'active' => true])->exists()){
            return $this->subscriptions()->save(
                    new Subscription([
                        'user_id' => $userId ?: auth()->id(),
                        'duration' => $this->duration,
                        'invoice_id' => $invoice_id,
                    ])
            );
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
        return $this->subscriptions()
            ->where(['user_id' => $user->id, 'active' => true])
            ->exists();
    }
}