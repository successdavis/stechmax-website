<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;
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
    // protected $fillable = [
    //     'f_name', 'l_name', 'email', 'password', 'paystack_id', 'phone', 'gender', 'avatar_path', ''
    // ];

    protected $guarded = [];

    protected $casts = [
        'confirmed' => 'boolean',
        'admin' => 'boolean'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function threads()
    {
        return $this->hasMany(Thread::class)->latest();
    }

    public function lastReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }

     public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function confirm()
    {
        $this->confirmed = true; 
        $this->confirmation_token = null;

        $this->save();
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

    public function updatePaystackId($paystackId)
    {
        if (empty($this->paystack_id)) {
            return $this->update([
                'paystack_id' => $paystackId
            ]);
        }
        return true;
    }

    public function getAvatarPathAttribute($avatar)
    {
        if ($avatar) {
            return asset('storage/' . $avatar);
        }else {
            return asset('storage/avatars/default.jpg');
        }
    }

    public function getPassportPathAttribute($passport)
    {
        if ($passport) {
            return asset('storage/' . $passport);
        }else {
            return asset('storage/passports/default.jpg');
        }
    }

    public function isAdmin()
    {
        // return in_array($this->f_name, ['JohnDoe', 'JaneDoe']);
        return $this->admin;
    }

}
 
