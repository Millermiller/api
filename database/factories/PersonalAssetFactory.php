<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learn\Domain\Entity\Asset;
use Scandinaver\Learn\Domain\Entity\PersonalAsset;

/** @var Factory $factory */
$factory->define(PersonalAsset::class, function (Faker $faker, array $attributes) {

    static $level = 1;

    $cards = entity(\Scandinaver\Learn\Domain\Entity\Card::class, 2)->create(['language' => $attributes['language']])->toArray();

    return [
      //  'id' => random_int(1, 999),
        'title' => $faker->unique()->text(50),
        'basic' => 0,
        'type' => Asset::TYPE_PERSONAL, //array_rand([0, 1, 2, 3]),
        'level' => 1,
        'favorite' => 0,
        'language' => $attributes['language'],
        'cards' => new \Doctrine\Common\Collections\ArrayCollection($cards)
    ];
});
