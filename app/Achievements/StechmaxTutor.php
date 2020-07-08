<?php

namespace App\Achievements;

use App\Achievement;

class StechmaxTutor extends AchievementType
{
	public $description	= 'When Best Reply reaches 100 and have been awared the preacher badge';
	public $icon 		= 'stechmax-tutor.png';


	public function qualifier($user)
	{
		if ($user->isPreacher() && $user->bestReplyCount() >= 100) {
			return true;
		}
	}

}