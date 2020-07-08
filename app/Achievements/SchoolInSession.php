<?php

namespace App\Achievements;

use App\Achievement;

class SchoolInSession extends AchievementType
{
	public $description	= 'You have completed atleast 10 lessons';
	public $icon 		= 'school-in-session.png';


	public function qualifier($user)
	{
		$Attendance = $user->experience()->where('description','Attendance')->count();
		return $Attendance >= 10;
	}

}