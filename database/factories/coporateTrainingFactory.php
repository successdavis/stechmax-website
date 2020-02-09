<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\coporatetraining;
use Faker\Generator as Faker;

$factory->define(coporatetraining::class, function (Faker $faker) {
    return [
        "begin_at"		=> $faker->date, 
        "endgoal"		=> $faker->paragraph, 
        "venue"			=> $faker->paragraph,
        "fee"			=> 5000,
        "user_id"			=> function() {
            return factory('App\User')->create()->id;
        },
    ];
});
