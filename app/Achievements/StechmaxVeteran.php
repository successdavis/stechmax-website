<?php

namespace App\Achievements;

use App\Achievement;

class StechmaxVeteran extends AchievementType
{
	public $description	= 'When Exp. reaches 10,000';
	public $icon 		= 'stechmax-veteran.png';


	public function qualifier($user)
	{
		return $user->experienceLevel() >= 10000;
	}

}