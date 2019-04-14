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
        return $this->hasMany(Course::class);
    }

    public function getSubjectCourses()
    {
        return $this->courses->where('type_id', 1);
    }

    // public function getSubjectTracks()
    // {
    //     return $this->courses->where('type_id', 2);
    // }
}
