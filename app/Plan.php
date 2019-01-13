<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['plan_id'];
    //

    public function courses()
    {
        return $this->belongsToMany('App\Plan', 'course_plans', 'plan_id', 'course_id');
    }
}
