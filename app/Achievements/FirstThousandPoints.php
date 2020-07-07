<?php

namespace App\Achievements;

use App\Achievement;

class FirstThousandPoints extends AchievementType
{
	public $description	= 'Great Job! Keep going';
	public $icon 		= 'first-thousand.svg';

	public function qualifier($user)
	{
		return $user->experienceLevel() >= 1000;
	}
}