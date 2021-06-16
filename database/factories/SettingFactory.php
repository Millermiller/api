<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Settings\Domain\Entity\Setting;

/** @var Factory $factory */
$factory->define(Setting::class, function (Faker $faker, array $attributes) {

    $name = $attributes['name'] ?? null;
    $slug = $attributes['slug'] ?? null;

    return [
        'title' => $name ?? $faker->unique()->word(),
        'slug' => $slug ?? $faker->unique()->word(),
        'data' => [
            Setting::TYPE_KEY  => 'string',
            Setting::VALUE_KEY => 'value',
        ]
    ];
});
