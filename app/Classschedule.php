<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classschedule extends Model
{

	protected $guarded = [];

    public function coporatetraining()
    {
    	return $this->belongsTo('App\Course');
    }
}
