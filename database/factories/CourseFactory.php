<?php

use Faker\Generator as Faker;




$factory->define(App\Type::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'icon_path' => '/images/course.jpg'
    ];
});


$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'subject_id' => function() {
            return factory('App\Subject')->create()->id;
        },
        'title' => $faker->unique()->sentence,
        'difficulty_id' => factory('App\Difficulty')->create(),
        'duration' => '3',
        'type_id' => function() {
            return factory('App\Type')->create()->id;
        },
        'published' => false,
        'amount' => '145000',
        'description' => 'Lorem ipsum occaecat labore exercitation id sunt in do laborum culpa elit laborum velit in voluptate non do ut proident ut do dolore dolore eiusmod consequat mollit quis dolore eiusmod elit cupidatat duis duis adipisicing occaecat ullamco ut ex in eu aliquip occaecat exercitation nulla enim sed ex amet enim occaecat ut in adipisicing duis nostrud dolor duis ullamco cillum ut elit id dolor irure culpa dolore ut sunt esse labore occaecat ut sit veniam excepteur proident sit mollit ea in excepteur deserunt elit eiusmod veniam deserunt ut id et exercitation et occaecat nisi consectetur quis fugiat consequat veniam cillum in amet nisi exercitation aute nisi aute in labore nisi laborum pariatur cillum reprehenderit ullamco consectetur sed dolore nisi sint in duis dolore officia consequat excepteur dolore aliqua laborum aliqua ut reprehenderit eu minim sed mollit do elit occaecat non exercitation aliquip officia nisi veniam eiusmod voluptate sunt enim ad pariatur non magna culpa deserunt cupidatat officia aute deserunt magna tempor excepteur velit tempor sint cupidatat magna tempor est qui eu ex duis dolor consequat minim occaecat ut eu dolor ullamco aliquip anim excepteur aliqua ex ut nostrud nostrud non aliquip et ut proident est elit ullamco proident et amet consequat cupidatat laboris sit dolore amet laboris incididunt aute fugiat officia nostrud et consectetur deserunt nostrud eiusmod laborum eu est eiusmod anim incididunt excepteur mollit proident velit duis aliquip.',
        'sypnosis' => 'In commodo esse non est consequat consequat mollit cupidatat labore id in enim laboris voluptate sed eiusmod cillum reprehenderit labore consequat aliquip ad eu dolore quis occaecat eu.',
    ];
});

$factory->state(App\Course::class, 'track', function () {
    return [
        'type_id' => 2 
    ];
});

$factory->state(App\Course::class, 'program', function () {
    return [
        'type_id' => 3
    ];
});

