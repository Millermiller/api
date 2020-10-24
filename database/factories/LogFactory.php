<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;



/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


/** @var Factory $factory */
$factory->define(\Scandinaver\Common\Domain\Model\Log::class, function (Faker $faker, array $attributes) {

    return [
        'message' => $faker->unique()->text(5),
        'context' => ['foo' => 'bar'],
        'level' => $faker->numberBetween(1, 5),
        'levelName' => $faker->unique()->text(10),
        'extra' => ['foo' => 'bar'],
        'createdAt' => $faker->dateTime(),
        'owner' => $attributes['user'],
    ];
});
