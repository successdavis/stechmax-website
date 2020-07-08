<?php

namespace App\Achievements;

use App\Achievement;

class WelcomeToTheCommunity extends AchievementType
{
	public $description	= 'Earned when you post your first thread';
	public $icon 		= 'welcome-to-the-community.png';


	public function qualifier($user)
	{
		return $user->threads()->count() >= 1;
	}

}