<?php

use Doctrine\Common\Collections\Collection;
use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\Result;
use Scandinaver\User\Domain\Model\User;

/** @var Factory $factory */
$factory->define(Asset::class, function (Faker $faker, array $attributes) {

    static $level = 1;

    $cards = entity(\Scandinaver\Learn\Domain\Model\Card::class, 2)->create(['language' => $attributes['language']])->toArray();

    return [
        'title' => $faker->unique()->text(50),
        'basic' => 1,
        'type' => 1, //array_rand([0, 1, 2, 3]),
        'level' => $level++,
        'favorite' =>  $attributes['favorite'] ?? 0,
        'language' => $attributes['language'],
        'users' => [$attributes['user']],
        'cards' => new \Doctrine\Common\Collections\ArrayCollection($cards)
    ];
});
