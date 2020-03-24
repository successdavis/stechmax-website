<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    protected $with = ['courses'];


    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function courses()
    {
        return $this->hasMany(Course::class)->where('published', true);
    }

    public function getSubjectCourses()
    {
        return $this->courses->where('type_id', 1);
    }

    public function getSubjectTracks()
    {
        return $this->courses->where('type_id', 2);
    }

    public function coursesCount()
    {
        return $this->courses->where('type_id', 1)->count();
    } 

    public function trackCount()
    {
        return $this->courses->where('type_id', 2)->count();
    }   
}
