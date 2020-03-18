<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
	protected $guarded = [];
    public function user()
    {	
    	return $this->belongsTo('App\User');
    }

    public function course()
    {
    	return $this->belongsTo('App\Course');
    }
}
