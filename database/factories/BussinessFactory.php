<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pricing;
use App\Business;
use Faker\Generator as Faker;

$factory->define(Business::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(Pricing::class, function (Faker $faker) {
    return [
        'description' 	=> $faker->sentence,
        'price' 		=> 4000,
        'business_id'	=> function () {
        	return factory('App\Business')->create()->id;
        }
    ];
});
