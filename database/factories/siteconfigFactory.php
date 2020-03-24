<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\siteconfig;
use Faker\Generator as Faker;

$factory->define(siteconfig::class, function (Faker $faker) {
    return [
        'classroom_fee'	=> '100000'
    ];
});
