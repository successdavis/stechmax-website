<?php

namespace App;

use App\Course;
use App\Events\UserEarnedExperience;
use App\Experience;
use App\Http\Resources\CourseSubscriptionsResource;
use App\SmartSms\SmartSms;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

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

    public function coporatetrainings()
    {
        return $this->hasMany(coporatetraining::class);
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

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function bestReplyCount()
    {
        return $this->replies->filter(function ($reply){ return $reply->isBest();})->count();
    }

    public function guardians()
    {
        return $this->hasOne(Guardian::class)->latest();
    }

    public function experience()
    {
        return $this->hasMany(Experience::class);
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

    public function MessageSystemNumber($subscription)
    {
        $message = 'You have subscribe to "' 
            . $subscription->subscriber->title 
            . '" you are assigned to use System '
            . $subscription->system_no;

        $this->smartSendMessage($message);
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

    public function smartSendMessage($message)
    {
        $smartsms = new SmartSms();
        
        $smartsms->message($this->phone, $message, 'S-TECHMAX');
    }

    public function date_joined()
    {
        return Carbon::parse($this->created_at)->toDayDateTimeString();
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

    public function createCoporateTraining()
    {
        return $this->coporatetrainings()->create([
            'begin_at'      => request('begin_at'),
            'endgoal'       => request('endgoal'),
            'venue'         => request('venue'),
            'personal_pc'   => null !== request('personal_pc') ? true : false,
            'fee'           => request('fee')
        ]);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    static public function totalUsers()
    {
        return self::count();
    }

    static public function totalThisMonth()
    {
        return self::whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->count();
    }

    static public function totalUsersWithSub()
    {
        return self::whereHas('subscriptions', function (Builder $query) {
            $query->where('active', true);
        })->count();
    }

    public function awardExperience($points, $description)
    {
        $experience = new Experience;
        $experience->points = $points;
        $experience->description = $description;
        $this->experience()->save($experience);

        UserEarnedExperience::dispatch($this, $this->experienceLevel());

        return $this;
    }

    public function stripExperience($points)
    {
        if ($points > $this->experienceLevel()) {
            abort(406, 'The user does not have upto this points');
        }
        
        $experience                = new Experience;
        $experience->points        = -$points;
        $experience->description   = "Experience strip off";
        $this->experience()->save($experience);

        UserEarnedExperience::dispatch($this, $this->experienceLevel());
        
        return $this;
    }

    public function experienceLevel()
    {
        return $this->experience()->sum('points');
    }

    // Get all invoices by a user and sum the total Amount
    public function getTotalAmountOfOpenInvoices()
    {
        $amount = $this->invoices()->whereCompleted(false)->sum('amount') / 100;
        
        return number_format(str_replace('-', '', $amount), 2);
    }

    // Get the total amount of debt a user is owing for all open invoices
    public function totalDebtForInvoices()
    {
        $openInvoices = $this->invoices()->whereCompleted(false)->get();
        $totalDebt = 0;
        foreach ($openInvoices as $invoice) {
            $totalDebt += $invoice->amountOwed();
        }

        return number_format(str_replace('-', '', $totalDebt / 100), 2);
        
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements');
    }

    public function markedAsPreacher()
    {
        $this->preacher = true;
        $this->save();
    }

    public function isPreacher()
    {
        return !! $this->preacher;
    }
}