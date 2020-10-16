<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'message'       => 'I need a website, can you make me one?',
        'phone'         => '09050635633',
        'email'         => 'simondavid612@gmail.com'
    ];
});
