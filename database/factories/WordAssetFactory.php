<?php

use Doctrine\Common\Collections\ArrayCollection;
use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learning\Asset\Domain\Entity\Card;
use Scandinaver\Learning\Asset\Domain\Entity\WordAsset;
use Scandinaver\Learning\Asset\Domain\Enum\AssetType;

/** @var Factory $factory */
$factory->define(WordAsset::class, function (Faker $faker, array $attributes) {

    static $level = 1;

    $cards = entity(Card::class, 2)->create(['language' => $attributes['language']])->toArray();

    return [
      //  'id' => random_int(1, 999),
        'title'    => $attributes['title'] ?? $faker->unique()->text(50),
        'basic'    => 1,
        'type'     => AssetType::WORDS, //array_rand([0, 1, 2, 3]),
        'level'    => $level++,
        'favorite' =>  $attributes['favorite'] ?? 0,
        'language' => $attributes['language'],
        'owner'    => $attributes['user'],
        'cards'    => new ArrayCollection($cards)
    ];
});
