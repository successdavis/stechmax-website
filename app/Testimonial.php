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

    public function approve()
    {
    	return $this->update([
    		'approve' => true,
    	]);
    }

    public function status()
    {
    	return !! $this->approve;
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
