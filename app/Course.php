<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    public function path()
    {
        return '/courses/' . $this->subject->slug . '/' . $this->id;
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

    public function subject()
    {
       return $this->belongsTo(Subject::class); // This is the category in which each course falls
    }

    public function learns()
    {
        return $this->hasMany('App\Learn');
    }

    public function requirements()
    {
        return $this->hasMany('App\Requirement');
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function getPlans()
    {
        return $this->plans;
    }
}
