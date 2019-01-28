<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_name', 'l_name', 'email', 'password', 'paystack_id', 'phone', 'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function threads()
    {
        return $this->hasMany(Thread::class)->latest();
    }

     public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments()
    {
        return $this->hasMany(Payments::class);
    }

    public function subscribeToCourse($course, $class = false)
    {
        $this->subscriptions()->create([
            'course_id' => $course->id,
            'duration' => $course->duration,
            'class' => $class,
            'active' => true
        ]);
    }

    public function getSubscribedCourses()
    {
        return $this->subscriptions();
    }

    public function deactivate($course)
    {
       return $this->subscriptions()
        ->where('course_id', $course->id)
        ->update([
            'active' => false,
            'subscription_end_at' => Carbon::now()
        ]);
    }

    public function activeCourses()
    {
        return $this->subscriptions()
            ->where('active', true);
    }

    public function isSubscribe($course)
    {
        return !! $this->subscriptions()->where('course_id', $course->id)
            ->where('active', true)->count();
    }

    public function updatePaystackId($paystackId)
    {
        return $this->update([
            'paystack_id' => $paystackId
        ]);
    }
}
 
