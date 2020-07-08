<?php

namespace App\Achievements;

use App\Achievement;

class StechmaxMaster extends AchievementType
{
	public $description	= 'When Experience Points reaches 100,000';
	public $icon 		= 'stechmax-master.png';


	public function qualifier($user)
	{
		return $user->experienceLevel() >= 100000;
	}

}