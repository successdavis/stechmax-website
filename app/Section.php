<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $with = ['topics'];
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function topics()
    {
        return $this->hasMany('App\Topic');
    }
}
