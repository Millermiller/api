<?php

use Faker\Generator as Faker;
use Scandinaver\Blog\Infrastructure\Persistence\Eloquent\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->text(20),
    ];
});