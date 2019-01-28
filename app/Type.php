<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $with = ['courses'];
    
    public function courses()
    {  
       return $this->hasMany(Course::class); 
    }

    static public function getCourseByType($type)
    {
        return static::where('name', $type);
    }
}
