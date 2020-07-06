<?php

namespace App\Achievements;

use App\Achievement;

class FirstThousandPoints
{
	public $name 		= 'First Thousand Points';
	public $description	= 'Great Job! Keep going';
	public $icon 		= 'first-thousand.svg';
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
		return $user->experienceLevel() >= 1000;
	}
	public function modelKey()
	{
		return $this->model->getKey();
	}
}