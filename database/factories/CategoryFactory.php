<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Learn\Domain\Model\WordAsset;

/** @var Factory $factory */
$factory->define(Category::class, function (Faker $faker, array $attributes) {

    return [
        'name' => $faker->unique()->text(50),
        'createdAt' => $faker->dateTime(),
        'updatedAt' => $faker->dateTime()
    ];
});
