<?php

namespace App\Achievements;

use App\Achievement;

class StechmaxEvangelist extends AchievementType
{
	public $description	= 'Earned when you invite users to S-Techmax';
	public $icon 		= 'stechmax-evangelist.png';


	public function qualifier($user)
	{
		return $user->isPreacher();
	}

}