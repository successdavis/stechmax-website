<?php

namespace App;

use Carbon\Carbon;
use App\SmartSms\SmartSms;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Course;
use App\Http\Resources\CourseSubscriptionsResource;
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
    protected $with = ['guardians'];

    protected $guarded = [];

    protected $casts = [
        'confirmed' => 'boolean',
        'phone_confirmed' => 'boolean',
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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user){
            $user->assignId();
        });

    }

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

    public function guardians()
    {
        return $this->hasOne(Guardian::class)->latest();
    }

    public function assignId()
    {
        $this->update([
            'user_id' => 'STM/' . date('Y') . '/B' . date('n') . '/' . sprintf('%04d', $this->id)
        ]);    
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

    public function confirmToken()
    {
        $this->phone_confirmed = true; 
        $this->phone_token = null;

        $this->save();

        return $this;
    }

    public function validateAndUpdatePassword($old_password = null, $new_password = null)
    {
        $old_password = !empty($old_password) ? $old_password : request('old_password');
        $new_password = !empty($new_password) ? $new_password : request('new_password');

        if(Hash::check($old_password, $this->password)){
             return $this->update([
                'password' => Hash::make($new_password)
             ]);
        }

        return false;
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

    public function totalActiveCourse($user = '')
    {
        return Course::WhereSubscribeBy($this)->get()->count();
    }

    public function getTotalAmountOwed()
    {
        $owed = 0;

        foreach ($this->invoices as $invoice) {
            $owed += $invoice->amountOwed();
        }

        return $owed / 100;
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

    public function retriveMyCourses() 
    {
        $subscriptions = Course::WhereSubscribeBy($this)->get();
            return CourseSubscriptionsResource::collection($subscriptions);
    }

    public function twilioSendMessage()
    {
        $accountId  =   config('services.twilio.account_sid');
        $token      =   config('services.twilio.token');
        $fromNumber =   '+17204596176';

        $twilio = new \Aloha\Twilio\Twilio($accountId, $token, $fromNumber);

        $twilio->message($this->phone, 'Hello World');
    }

    public function smartSendToken()
    {   
            $token = $randomid = mt_rand(100000,999999); 
            $this->update([
                'phone_token' => $token
            ]);

            $message = 'Activation Token: ' . $token;

            $smartsms = new SmartSms();

            $smartsms->message($this->phone, $message, 'S-TECHMAX');

            return true;
    }

    public function canSendNewToken()
    {
        if ($this->updated_at->diffInMinutes() >= 5) {
            return true;
        }
       
       return false;
    }

    public function updatePassword($password)
    {
        $this->password = Hash::make($password);

        $this->save();
    }

    public function verified()
    {
        return $this->confirmed || $this->phone_confirmed;
    }
}