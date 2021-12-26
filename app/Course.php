<?php

namespace App;
use App\Lecture;
use Illuminate\Database\Eloquent\Model;
use Paystack;

class Course extends Model
{
    protected $guarded = [];

    use Billable;
    use Subscriber;

    protected $casts = [
        'published' => 'boolean'
    ];

    protected $appends = ['isSubscribedBy'];
//    private $type;

    protected static function boot()
    {
        parent::boot();

        static::created(function ($course) {
            $course->update(['slug' => $course->title]);
        });
    }

    public function setSlugAttribute($value)
    {
        $slug = str_slug($value);

        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-" . $this->id;
        }

        $this->attributes['slug'] = $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return '/courses/' . $this->subject->slug . '/' . $this->slug;
    }

    public function getPathAttribute()
    {
        return $this->path();
    }

    // public function getVideoPathAttribute($videoPath)
    // {
    //     if ($videoPath) {
    //         return asset('storage/' . $videoPath);
    //     }else {
    //         return asset('storage/promovideo/default.mp4');
         // return null;
    //     }
    // }


    public function getThumbnailPathAttribute($course) {
        if ($course) {
            return asset('storage/' . $course);
        }else {
            return asset('storage/thumbnails/default.jpg');
        }
    }

    public function coporatetraining()
    {
        return $this->belongsToMany('App\coporatetraining');
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function publish()
    {
        $this->update([
            'published' => true
        ]);

        return true;
    }

    public function unPublish()
    {
        $this->update([
            'published' => false
        ]);

        return true;
    }

    public function checkCustomCourse()
    {
        return !! $this->custom_course;
    }

    public function childrenCourses()
    {
        return $this->belongsToMany('App\Course', 'course_tracks','track_id','course_id')->withPivot('order');
    }

    public function getSections()
    {
        return $this->sections()->orderBy('order')->get();
    }

    public function testimonials()
    {
        return $this->hasMany('App\Testimonial');
    }

    public function parentCourse()
    {
        return $this->belongsToMany('App\Course', 'course_tracks','course_id','track_id')->withPivot('order');
    }

    public function attachCourseToTrack($course)
    {
        $order = 1;
        if ($this->childrenCourses()->whereOrder($order)->exists()) {
            $order = $this->incrementOrder();
        }
        $this->childrenCourses()->attach($course->id, ['order' => $order]);
    }

    public function detachCourseFromTrack($course)
    {
        $this->childrenCourses()->detach($course->id);
    }

    public function incrementOrder()
    {
        $order = 1;
        while($this->childrenCourses()->whereOrder($order)->exists()) {
            $order++;
        }
        return $order;
    }

    public function plans()
    {
        return $this->belongsToMany('App\Plan', 'course_plans', 'course_id', 'plan_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function checkType()
    {
        return $this->type->name;
    }

    public function subject()
    {
       return $this->belongsTo(Subject::class); // This is the category in which each course falls
    }

    public function learns()
    {
        return $this->hasMany('App\Learn')->orderBy('order');
    }

    public function requirements()
    {
        return $this->hasMany('App\Requirement')->orderBy('order');
    }

    public function addRequirement($requirement)
    {
        $requirement = $this->requirements()->create($requirement);

        return $requirement;
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function addSection($section)
    {
        $section = $this->sections()->create($section);

        return $section;
    }

     public function difficulty()
    {
        return $this->belongsTo(Difficulty::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function getPlans()
    {
        return $this->plans;
    }

    public function createPlanOnPaystack()
    {
        $data = [
            "name" => $this->title,
            "description" => $this->description,
            "amount" => intval($this->amount),
            // "key" => config('paystack.secretKey'),
            "interval" => 'monthly',
        ];

        $plan = Paystack::createPlan($data);

        return $this->update([
            'plan_code' => $plan['data']['plan_code']
        ]);
    }

    public function getFirstInstallment($course = null, $classroomfee = null, $format = true)
    {
        $amount = !empty($course) ? $course->amount * 60 / 100 : $this->amount * 60 / 100;
        if (filter_var($classroomfee, FILTER_VALIDATE_BOOLEAN)) {
            $classroomfee = $this->classroomfee();
            $amount = $amount + $classroomfee;
        }

        return $format ? number_format($amount / 100, 2) : $amount;
    }





    public function calculateDiscount($amount) {

        $discountInDecimal = $this->discount_percentage / 100;

        $percentageAmount = $discountInDecimal * $amount;

        return $newAmount = $amount - $percentageAmount;
    }


    public function getAmount($format = true)
    {
        $amount = $this->type_id === 2 ? $this->getTrackAmount() : $this->amount;

        return $format ? number_format($amount / 100,2) : $amount;
    }

    public function getDiscountAmount($format = true)
    {
        $amount = $this->getAmount(false);

        $discountedAmount = $this->calculateDiscount($amount);

        return $format ? number_format($discountedAmount / 100, 2) : $discountedAmount;
    }

    public function getClassAmount($format = true)
    {
        $amount = $this->type_id === 2 ? $this->getTrackClassAmount() : $this->class_amount;

        return $format ? number_format($amount / 100, 2) : $amount;
    }

    public function getClassAmountDiscount($format = true)
    {
        $amount = $this->getClassAmount(false);

        $discountedAmount = $this->calculateDiscount($amount);

        return $format ? number_format($discountedAmount / 100, 2) : $discountedAmount;
    }


    public function supportPartPayment()
    {
        return !! $this->partpayment;
    }

    public function enablePartPayment()
    {
        return $this->update([
            'partpayment' => true,
        ]);
    }

    public function firstLectureUrl()
    {
        $lecture = $this->lectures->first->get();

        if ($lecture) {
            return $lecture->path;
        }
        return '';
    }

    public function hasActiveSubscription($userId = null)
    {
        $userId = $userId ? $userId : auth()->id();
        return $this->subscriptions()->where(['user_id' => $userId, 'active' => true])->exists();
    }


    // Get the amount for track courses (online study)
    public function getTrackAmount() {
        
        // this variable holds the default discount for all track courses
        $percentageDiscount = 10;
        $amount = $this->childrencourses()->sum('amount');

        $percentageAmount = $percentageDiscount / 100 * $amount;

        return $amount - $percentageAmount;
    }

    // Get the amount for track courses (classroom study)
    public function getTrackClassAmount() {
        
        // this variable holds the default discount for all track courses
        $percentageDiscount = 10;

        $amount = $this->childrencourses()->sum('class_amount');

        $percentageAmount = $percentageDiscount / 100 * $amount;

        return $amount - $percentageAmount;
    }
}
