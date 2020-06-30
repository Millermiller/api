<?php

use Faker\Generator as Faker;
use Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Translate;


$factory->define(Translate::class, function () {

    $faker = \Faker\Factory::create('ru_RU');

    return [
        'value' => $faker->unique()->colorName,
        'sentence' => 0,
    ];
});