<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Common\Domain\Entity\Language;

/** @var Factory $factory */
$factory->define(Language::class, function (Faker $faker, array $attributes) {

    return [
        'letter' => $attributes['letter'],
        'active' => 1,
        'title' => $faker->unique()->text(10),
        'flag' => '/img/is_round.png',
        'image' => '/img/is_round.png',
    ];
});
