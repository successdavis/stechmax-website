<?php

namespace App;

use App\Events\UserEarnedExperience;

trait Experience
{
    public function awardExperience($points)
    {
    	$this->increment('points', $points);

    	UserEarnedExperience::dispatch($this, $this->points);

    	return $this;
    }

    public function stripExperience($points)
    {
    	$this->points -= $points;

    	if($this->points < 0 ){
    		$this->points = 0;
    	}
    }

    public function experienceLevel()
    {
        return $this->points;
    }
}
