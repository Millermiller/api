<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Blog\Domain\Entity\Comment;

/** @var Factory $factory */
$factory->define(Comment::class, function (Faker $faker, array $attributes) {

    return [
        'post' => $attributes['post'],
        'user' => $attributes['user'],
        'text' => $faker->unique()->text(50),
        'createdAt' => $faker->dateTime(),
        'updatedAt' => $faker->dateTime()
    ];
});
