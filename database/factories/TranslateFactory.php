<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;

/** @var Factory $factory */
$factory->define(\Scandinaver\Learn\Domain\Model\Translate::class, function (Faker $faker, array $attributes) {

    return [
       // 'id' => random_int(1, 999),
        'word' => $attributes['word'],
        'value' => $faker->unique()->word(),
        'sentence' => 0,
    ];
});
