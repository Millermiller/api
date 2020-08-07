<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\User\Domain\Model\User;


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
$factory->define(\Scandinaver\Common\Domain\Model\Language::class, function (Faker $faker) {

    return [
        'name' => 'is',
        'label' => 'Исландский!',
        'flag' => '/img/is_round.png',
    ];
});
