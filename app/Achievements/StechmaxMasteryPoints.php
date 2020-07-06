<?php

namespace App\Achievements;

use App\Achievement;

class StechmaxMasteryPoints
{
	public $name 		= 'Stechmax Mastery Points';
	public $description	= 'You made it to the master';
	public $icon 		= 'master.svg';
	protected $model;

	public function __construct()
	{
		$this->model = Achievement::firstOrCreate([
			'name' 			=> $this->name,
			'description'	=> $this->description,
			'icon'			=> $this->icon,
		]);
	}

	public function qualifier($user)
	{
		return $user->experienceLevel() >= 5000;
	}
	public function modelKey()
	{
		return $this->model->getKey();
	}
}