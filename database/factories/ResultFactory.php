<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learn\Domain\Model\Asset;

/** @var Factory $factory */
$factory->define(\Scandinaver\Learn\Domain\Result::class, function (Faker $faker, array $attributes) {

    static $level = 1;

    return [
        'result' => $faker->unique()->numberBetween(0, 100),
        'user' => $attributes['user'],
        'language' => $attributes['language'],
        'asset' => $attributes['asset'],
    ];
});