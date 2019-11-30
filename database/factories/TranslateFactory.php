<?php

use Faker\Generator as Faker;



$factory->define(App\Models\Translate::class, function () {

    $faker = \Faker\Factory::create('ru_RU');

    return [
        'value' => $faker->unique()->colorName,
        'sentence' => 0,
    ];
});