<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\RBAC\Domain\Entity\PermissionGroup;

/** @var Factory $factory */
$factory->define(Permission::class, function (Faker $faker, array $attributes) {

    $name = $attributes['name'] ?? null;
    $slug = $attributes['slug'] ?? null;

    $group = entity(PermissionGroup::class, 1)->create();

    return [
        'name' => $name ?? $faker->unique()->word(),
        'slug' => $slug ?? $faker->unique()->word(),
        'description' => $faker->unique()->text(150),
        'group' => $group,
        'updatedAt' => $faker->dateTime()
    ];
});
