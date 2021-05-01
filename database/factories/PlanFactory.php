<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\User\Domain\Model\Plan;


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
$factory->define(Plan::class, function (Faker $faker) {
    return [
        'name' => 'Basic',
        'period' => 10,
        'cost' => 10,
        'costPerMonth' => 10,
    ];
});