<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function path()
    {
        return '/courses/' . $this->id;
    }

    public function childrenCourses()
    {
        return $this->belongsToMany('App\Course', 'course_tracks','track_id','course_id');
    }

    public function ParentCourse()
    {
        return $this->belongsToMany('App\Course', 'track_courses','course_id','track_id');
    }
}
