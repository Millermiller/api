<?php

use Faker\Generator as Faker;

$factory->define(App\Helpers\Eloquent\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->text(20),
    ];
});