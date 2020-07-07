<?php

namespace App\Achievements;

use App\Achievement;

class StechmaxMasteryPoints extends AchievementType
{
	public $description	= 'You made it to the master';
	public $icon 		= 'master.svg';


	public function qualifier($user)
	{
		return $user->experienceLevel() >= 5000;
	}

}