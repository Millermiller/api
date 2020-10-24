<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learn\Domain\Model\Word;

/** @var Factory $factory */
$factory->define(\Scandinaver\Learn\Domain\Model\Card::class, function (Faker $faker, array $attributes) {

    /** @var Word $word */
    $word = entity(Word::class)->create([
        'language' => $attributes['language'],
        'creator' => null
    ]);

    $translate = entity(\Scandinaver\Learn\Domain\Model\Translate::class)->create(['word' => $word]);

    return [
        'word' => $word,
        'translate' => $translate,
        'asset' => $attributes['asset'] ?? null
    ];
});
