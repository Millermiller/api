<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learn\Domain\Entity\Term;

/** @var Factory $factory */
$factory->define(Term::class, function (Faker $faker, array $attributes) {

    return [
        //'id' => random_int(1, 999),
        'audio' => 'fakeurl',
        'sentence' => 0,
        'isPublic' => true,
        'value' => $faker->unique()->word(),
        'translate' => $faker->unique()->word(),
        'language' => $attributes['language']
    ];
});
