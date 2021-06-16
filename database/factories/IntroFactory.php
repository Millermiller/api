<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Common\Domain\Entity\Intro;

/** @var Factory $factory */
$factory->define(Intro::class, function (Faker $faker, array $attributes) {

    return [
        'page' => $faker->unique()->text(10),
        'target' => $faker->unique()->text(10),
        'content' => $faker->unique()->text(50),
        'position' => $faker->unique()->text(10),
        'tooltipClass' => $faker->unique()->text(10),
        'sort' => $faker->unique()->numberBetween(1, 10),
        'active' => 1,
        'createdAt' => $faker->dateTime(),
        'updatedAt' => $faker->dateTime()
    ];
});
