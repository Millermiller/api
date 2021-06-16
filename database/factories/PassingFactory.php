<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learn\Domain\Entity\Passing;

/** @var Factory $factory */
$factory->define(Passing::class, function (Faker $faker, array $attributes) {

    return [
       // 'id' => random_int(1, 999),
        'result' => $faker->unique()->numberBetween(0, 100),
        'user' => $attributes['user'],
        'asset' => $attributes['asset'],
        'language' => $attributes['language'],
        'completed' => 1,
        'percent' => 100,
    ];
});