<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Classschedule;
use Faker\Generator as Faker;

$factory->define(Classschedule::class, function (Faker $faker) {
    return [
        'coporatetraining_id' => function() {
        	return factory('App\coporatetraining')->create()->id;
        },
        'day'			=> 'Monday',
        'lecturetime'	=> $faker->time($format = 'H:i:s', $max = 'now'),


    ];
});
