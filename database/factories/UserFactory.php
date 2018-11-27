<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'img' => 'course/zT0t57KV33SwqOF9FB0eKZklb1FLmBntv0mIgJ8C.jpeg',
        'duration' => '3',
        'fee' => '30000',
        'description' => $faker->paragraph,
        'sypnosis' => $faker->sentence,
    ];
});

$factory->define(App\Course_Track::class, function (Faker $faker) {
    return [
        'track_id' => function () {
            return factory('App\Course')->create(['fee' => '10000'])->id;
        },

        'course_id' => function () {
            return factory('App\Course')->create()->id;
        },
    ];
});

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'title' => $faker->sentence,
        'body'  => $faker->paragraph
    ];
});

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'title' => $faker->sentence,
        'body'  => $faker->paragraph
    ];
});


$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'thread_id' => function() {
            return factory('App\Thread')->create()->id;
        },
        'body'  => $faker->paragraph
    ];
});
