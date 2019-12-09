<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expeirence extends Model
{
    protected $fillable = ['user_id', 'award_count', 'points'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function awardExperience($points)
    {
    	$this->increment('points', $points);

    	UserEarnedExperience::dispatch($this->user, $this->points);

    	return $this;
    }

    public function stripExperience($points)
    {
    	$this->points -= $points;

    	if($this->points < 0 ){
    		$this->points = 0;
    	}
    }
}
