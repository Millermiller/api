<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\User\Domain\Entity\Plan;

/** @var Factory $factory */
$factory->define(Plan::class, function (Faker $faker) {
    return [
        'name' => 'Basic',
        'period' => 10,
        'cost' => 10,
        'costPerMonth' => 10,
    ];
});