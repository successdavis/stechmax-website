<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coporatetraining extends Model
{

	protected $guarded = [];

	protected $maxLectures = 3;

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function courses()
	{
		return $this->belongsToMany('App\Course');
	}
	
	public function addCourses($courses)
	{
		return $this->courses()->attach($courses);
	}

	public function classSchedule()
	{	
		return $this->hasMany('App\Classschedule');
	}

	public function addSchedule($data)
	{
		if (count($data) > $this->maxLectures) {
            abort(413, 'Maximum number of lectures exceeded');
		}

		foreach ($data as $schedule) {
			$this->classSchedule()->create([
				'day'			=> $schedule['day'],
				'lecturetime'	=> $schedule['lecturetime'],
			]);
		}

		return response(200);
	}
}
