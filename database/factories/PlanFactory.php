<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Billing\Domain\Entity\Plan;

/** @var Factory $factory */
$factory->define(Plan::class, function (Faker $faker) {
    return [
        'name' => 'Basic',
        'period' => (new DateInterval('P1M')),
        'cost' => 10,
        'costPerMonth' => 10,
    ];
});