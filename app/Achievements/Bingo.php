<?php

namespace App\Achievements;

use App\Achievement;

class Bingo extends AchievementType
{
	public $description	= 'Great Job! Keep going';
	public $icon 		= 'bingo.png';


	public function qualifier($user)
	{
		return $user->experienceLevel() >= 1000;
	}

}