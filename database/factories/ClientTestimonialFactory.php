<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use App\clienttestimonial;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
   return [
       'fullname'       => $faker->name,
       'gender'         => $faker->name('male'),
       'phone'          => $faker->phoneNumber,
       'alt_phone'     => $faker->phoneNumber,
   ];
});

$factory->define(clienttestimonial::class, function (Faker $faker) {
    return [
        'testimonial'   => $faker->sentence,
        'rate'          => 1,
        'client_id'        => function() {
                return factory('App\Client')->create()->id;
        }
    ];
});
