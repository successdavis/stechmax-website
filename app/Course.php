<?php

namespace App;
use Paystack;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];
//    protected $appends = ['path'];

    use Billable;
    use Subscriber;

    protected $casts = [
        'published' => 'boolean'
    ];

    // protected $with = ['subscriptions'];


    public function path()
    {
        return '/courses/' . $this->subject->slug . '/' . $this->id;
    }

    public function getPathAttribute()
    {
        return $this->path();
    }


    public function getThumbnailPathAttribute($course) {
        if ($course) {
            return asset('storage/' . $course);
        }else {
            return asset('storage/thumbnails/default.jpg');
        }
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

    public function parentCourse()
    {
        return $this->belongsToMany('App\Course', 'track_courses','course_id','track_id')->withPivot('order');
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



    public function getFirstInstallment($course = null)
    {
        return !empty($course) ? $course->amount * 60 / 100 : $this->amount * 60 / 100;
    }
}
