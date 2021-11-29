<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learning\Asset\Domain\Entity\Card;
use Scandinaver\Learning\Asset\Domain\Entity\FavouriteAsset;

/** @var Factory $factory */
$factory->define(FavouriteAsset::class, function (Faker $faker, array $attributes) {

    static $level = 1;

    $cards = entity(Card::class, 2)->create(['language' => $attributes['language']])->toArray();

    return [
      //  'id' => random_int(1, 999),
        'title' => $faker->unique()->text(50),
        'basic' => 1,
        'type' => 1, //array_rand([0, 1, 2, 3]),
        'level' => $level++,
        'favorite' =>  $attributes['favorite'] ?? 0,
        'language' => $attributes['language'],
        'cards' => new \Doctrine\Common\Collections\ArrayCollection($cards)
    ];
});
