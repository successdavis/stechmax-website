<?php

use Faker\Generator as Faker;

$factory->define(App\Video::class, function (Faker $faker) {
	$lecture = factory('App\Lecture')->create();
    return [
        'url' 			=> 'videos/' . $lecture->title,
        'lecture_id' 	=> $lecture->id,
        'duration'		=> '2',
        'type'			=> 'Mp4',
        'billable'		=> true
    ];
});
