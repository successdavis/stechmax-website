<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];
//    protected $appends = ['path'];


    public function path()
    {
        return '/courses/' . $this->subject->slug . '/' . $this->id . '/' . $this->title;
    }

    public function getPathAttribute()
    {
        return $this->path();
    }


    public function getThumbnailPathAttribute($course) {
        if ($course) {
            return asset('storage/' . $course);
        }else {
            return asset('storage/thumbnails/default.png');
        }
    }

    public function childrenCourses()
    {
        return $this->belongsToMany('App\Course', 'course_tracks','track_id','course_id');
    }

    public function ParentCourse()
    {
        return $this->belongsToMany('App\Course', 'track_courses','course_id','track_id');
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
        return $this->hasMany('App\Learn');
    }

    public function addLearn($learn)
    {
        $learn = $this->requirements()->create($learn);

        return $learn;
    }

    public function requirements()
    {
        return $this->hasMany('App\Requirement');
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

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function difficulties()
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

    public function getFirstInstallment($course = null)
    {
        return !empty($course) ? $course->fee * 60 / 100 : $this->fee * 60 / 100;
    }
}
