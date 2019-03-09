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
        'f_name' => $faker->name,
        'l_name' => $faker->name,
        'gender' => $faker->name,
        'phone' => '09061260072',
        'email' => $faker->unique()->safeEmail,
        'confirmed' => true,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->state(App\User::class, 'unconfirmed', function () {
    return [
        'confirmed' => false 
    ];
});

$factory->state(App\User::class, 'administrator', function () {
    return [
        'admin' => true 
    ];
});

$factory->define(App\Subject::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'slug'  => $name
    ];
});



$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'subject_id' => function() {
            return factory('App\Subject')->create()->id;
        },
        'title' => $faker->sentence,
        'img' => 'default_course.jpg',
        'difficulty' => 'Beginner',
        'duration' => '3',
        'type_id' => function() {
            return factory('App\Type')->create()->id;
        },
        'fee' => '145000',
        'description' => 'Lorem ipsum occaecat labore exercitation id sunt in do laborum culpa elit laborum velit in voluptate non do ut proident ut do dolore dolore eiusmod consequat mollit quis dolore eiusmod elit cupidatat duis duis adipisicing occaecat ullamco ut ex in eu aliquip occaecat exercitation nulla enim sed ex amet enim occaecat ut in adipisicing duis nostrud dolor duis ullamco cillum ut elit id dolor irure culpa dolore ut sunt esse labore occaecat ut sit veniam excepteur proident sit mollit ea in excepteur deserunt elit eiusmod veniam deserunt ut id et exercitation et occaecat nisi consectetur quis fugiat consequat veniam cillum in amet nisi exercitation aute nisi aute in labore nisi laborum pariatur cillum reprehenderit ullamco consectetur sed dolore nisi sint in duis dolore officia consequat excepteur dolore aliqua laborum aliqua ut reprehenderit eu minim sed mollit do elit occaecat non exercitation aliquip officia nisi veniam eiusmod voluptate sunt enim ad pariatur non magna culpa deserunt cupidatat officia aute deserunt magna tempor excepteur velit tempor sint cupidatat magna tempor est qui eu ex duis dolor consequat minim occaecat ut eu dolor ullamco aliquip anim excepteur aliqua ex ut nostrud nostrud non aliquip et ut proident est elit ullamco proident et amet consequat cupidatat laboris sit dolore amet laboris incididunt aute fugiat officia nostrud et consectetur deserunt nostrud eiusmod laborum eu est eiusmod anim incididunt excepteur mollit proident velit duis aliquip.',
        'sypnosis' => 'In commodo esse non est consequat consequat mollit cupidatat labore id in enim laboris voluptate sed eiusmod cillum reprehenderit labore consequat aliquip ad eu dolore quis occaecat eu.',
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

$factory->define(App\Channel::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'slug'  => $name
    ];
});

$factory->define(App\Thread::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'channel_id' => function() {
            return factory('App\Channel')->create();
        },
        'title' => $title,
        'body'  => $faker->paragraph,
        'visits' => 0,
        'slug' => str_slug($title),
        'locked' => false
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
        'body'  => '$faker->paragraph'
    ];
});

$factory->define(App\Learn::class, function (Faker $faker) {
    return [
        'course_id' => function() {
            return factory('App\Course')->create()->id;
        },
        'body'  => $faker->sentence
    ];
});

$factory->define(App\Requirement::class, function (Faker $faker) {
    return [
        'course_id' => function() {
            return factory('App\Course')->create()->id;
        },
        'body'  => $faker->sentence
    ];
});

$factory->define(App\Type::class, function (Faker $faker) {
    return [
        'name'  => $faker->word
    ];
});

$factory->define(App\Section::class, function (Faker $faker) {
    return [
        'course_id' => function() {
            return factory('App\Course')->create()->id;
        },
        'title'  => $faker->word
    ];
});

$factory->define(App\Topic::class, function (Faker $faker) {
    return [
        'section_id' => function() {
            return factory('App\Section')->create()->id;
        },
        'title'  => $faker->sentence
    ];
});


$factory->define(App\Subscription::class, function (Faker $faker) {
    return [
        'course_id' => function() {
            return factory('App\Course')->create()->id;
        },
        'user_id'  => function() {
            return factory('App\User')->create()->id;
        },
        'active' => true,
        'duration' => 3
    ];
});

$factory->define(App\Invoice::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'course_id' => function() {
            return factory('App\Course')->create()->id;
        },
        'amount'  => 50000,
        'active' => true,
        'valid' => true
    ];
});

$factory->define(App\Payments::class, function (Faker $faker) {
    return [
        'invoice_id' => function() {
            return factory('App\Invoice')->create()->id;
        },
        'amount'  => 30000,
        'method' => 'paystack',
        'purpose' => 'course registration',
        'transaction_ref' => $faker->word
    ];
});
