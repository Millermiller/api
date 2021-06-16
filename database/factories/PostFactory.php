<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Blog\Domain\Entity\Post;

/** @var Factory $factory */
$factory->define(Post::class, function (Faker $faker, array $attributes) {

    return [
        'user' => $attributes['user'],
        'category' => $attributes['category'],
        'title' => $faker->unique()->text(20),
        'content' => $faker->unique()->text(150),
        'anonce' => $faker->unique()->text(50),
        'status' => 1,
        'commentStatus' => 1,
        'views' => 0,
        'createdAt' => $faker->dateTime(),
        'updatedAt' => $faker->dateTime()
    ];
});
