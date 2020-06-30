<?php

use Faker\Generator as Faker;
use Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Asset;

$factory->define(Asset::class, function (Faker $faker) {

    static $level = 1;

    return [
        'title' => $faker->unique()->text(50),
        'basic' => 1,
        'type' => 1, //array_rand([0, 1, 2, 3]),
        'level' => $level++,
        'favorite' =>  0,
        'language_id' =>  1,
    ];
});