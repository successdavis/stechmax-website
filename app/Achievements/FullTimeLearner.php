<?php

namespace App\Achievements;

use App\Achievement;

class FullTimeLearner extends AchievementType
{
	public $description	= 'You have completed atleast 100 lessons ';
	public $icon 		= 'full-time-learner.png';


	public function qualifier($user)
	{
		$Attendance = $user->experience()->where('description','Attendance')->count();
		return $Attendance >= 100;
	}

}