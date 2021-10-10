<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learn\Domain\Entity\Example;

/** @var Factory $factory */
$factory->define(Example::class, function (Faker $faker, array $attributes) {

    return [
        'text' => $faker->unique()->text(10),
        'value' => $faker->unique()->text(10),
       // 'card' => $attributes['asset'] ?? null,
    ];
});
