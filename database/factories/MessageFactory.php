<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Common\Domain\Entity\Feedback;

/** @var Factory $factory */
$factory->define(Feedback::class, function (Faker $faker, array $attributes) {

    return [
        'message' => $faker->unique()->text(50),
        'name' => $faker->unique()->text(5),
        'createdAt' => $faker->dateTime(),
    ];
});
