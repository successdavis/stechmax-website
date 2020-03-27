<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'f_name' => $faker->word,
        'l_name' => $faker->word,
        'm_name' => $faker->word,
        'username' => $faker->word,
        'gender' => 'M',
        'phone' => '08076727008',
        'email' => $faker->unique()->safeEmail,
        'r_address' => '#1 Hospital Lane Obudu',
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
    $name = $faker->unique()->word;
    return [
        'name' => $name,
        'slug'  => $name,
        'icon_path'  => 'subject_icon.png',
    ];
});

$factory->define(App\Guardian::class, function (Faker $faker) {
    
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'name' => $faker->name,
        'title' => $faker->word,
        'occupation' => $faker->word,
        'company_name' => $faker->word,
        'work_address' => $faker->word,
        'phone' => '08076727008',
        'alternative_phone' => '09050635733',
        'email' => $faker->unique()->safeEmail,
        'r_address' => '#77 Imota Road Kaduna',
        'relationship' => 'father',
    ];
});

$factory->define(App\Difficulty::class, function (Faker $faker) {
    return [
        'level' => $faker->unique()->word
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
        'body'  => $faker->sentence,
    ];
});

$factory->define(App\Requirement::class, function (Faker $faker) {
    return [
        'course_id' => function() {
            return factory('App\Course')->create()->id;
        },
        'body'  => $faker->sentence,
    ];
});

$factory->define(App\Section::class, function (Faker $faker) {
    return [
        'course_id' => function() {
            return factory('App\Course')->create()->id;
        },
        'title'  => $faker->word,
        'description'  => $faker->sentence,
        'order'  => 1,
    ];
});

$factory->define(App\Lecture::class, function (Faker $faker) {
    return [
        'section_id' => function() {
            return factory('App\Section')->create()->id;
        },
        'title'  => $faker->sentence,
        'order'  => 1,
        'billable'  => true,
    ];
});


$factory->define(App\Subscription::class, function (Faker $faker) {
    return [
        'user_id'  => function() {
            return factory('App\User')->create()->id;
        },
        'active'    => true,
        'duration'  => 1,
        'class'     => true,
        'invoice_id'     => 1,
        'subscriber_id'     => 1,
        'subscriber_type'     => 'App\Course',
        'duration'     => '3',
    ];
});

$factory->define(App\Invoice::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'billable_id' => function() {
            return factory('App\Course')->create()->id;
        },
        'billable_type' => 'App\Course',
        'amount'  => 5000,
        'completed' => false,
        'invoiceNo' => 'STM-' . date('Y') . '-001',
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
