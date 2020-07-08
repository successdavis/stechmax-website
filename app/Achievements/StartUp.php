<?php

namespace App\Achievements;

use App\Achievement;

class StartUp extends AchievementType
{
	public $description	= 'Earned Onced Exp Reach 500 Points';
	public $icon 		= 'start-up.png';


	public function qualifier($user)
	{
		return $user->experienceLevel() >= 100;
	}

}