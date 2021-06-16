<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use \Scandinaver\Common\Domain\Entity\Log as Log;

/** @var Factory $factory */
$factory->define(Log::class, function (Faker $faker, array $attributes) {

    return [
        'message' => $faker->unique()->text(5),
        'context' => ['foo' => 'bar'],
        'level' => $faker->numberBetween(1, 5),
        'levelName' => $faker->unique()->text(10),
        'extra' => ['foo' => 'bar'],
        'createdAt' => $faker->dateTime(),
        'owner' => $attributes['user'],
    ];
});
