<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Common\Domain\Model\Language;


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
$factory->define(Language::class, function (Faker $faker, array $attributes) {

    return [
        'name' => $attributes['name'],
        'label' => $faker->unique()->text(10),
        'flag' => '/img/is_round.png',
    ];
});
