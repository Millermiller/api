<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;

/** @var Factory $factory */
$factory->define(\Scandinaver\RBAC\Domain\Model\Role::class, function (Faker $faker, array $attributes) {

    $name = $attributes['name'] ?? null;
    $slug = $attributes['slug'] ?? null;

    return [
        'name' => $name ?? $faker->unique()->word(),
        'slug' => $slug ?? $faker->unique()->word(),
        'description' => $faker->unique()->text(150),
        'createdAt' => $faker->dateTime(),
        'updatedAt' => $faker->dateTime()
    ];
});
