<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\User\Domain\Model\Plan;
use Scandinaver\User\Domain\Model\User;

/** @var Factory $factory */
$factory->define(User::class,
    function (Faker $faker) {

        $plan = entity(Plan::class)->create();

        return [
            'name'           => $faker->name,
            'login'          => $faker->unique()->firstName,
            'email'          => $faker->unique()->safeEmail,
            'plan'           => $plan,
            'photo'          => '5cb37ef3791a9.jpg',
            'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => Str::random(10),
            'activeTo'       => new DateTime(),
            'active'         => 1,
        ];
    });