<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Testimonial;
use Faker\Generator as Faker;

$factory->define(Testimonial::class, function (Faker $faker) {
    return [
        'testimonial' 		=>	$faker->sentence,
        'user_id'			=>	function () {
        	return factory('App\User')->create()->id;
		},
        'course_id'			=>	function () {
			return factory('App\Course')->create()->id;
        },
    ];
});
