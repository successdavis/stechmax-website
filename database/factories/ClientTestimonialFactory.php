<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use App\clienttestimonial;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
   return [
       'title'          => 'Mr.',
       'fullname'       => $faker->name,
       'gender'         => 'M',
       'phone'          => $faker->phoneNumber,
       'alt_phone'      => $faker->phoneNumber,
       'email'          => $faker->email,
   ];
});

$factory->define(clienttestimonial::class, function (Faker $faker) {
    return [
        'testimonial'   => $faker->sentence,
        'recommendation_rate'       => 1,
        'satisfaction_rate'         => 1,
        'suggestion'                => 'Upgrade your site',
        'client_id'        => function() {
                return factory('App\Client')->create()->id;
        }
    ];
});
