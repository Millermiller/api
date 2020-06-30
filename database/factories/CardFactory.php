<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Learn\Domain\Result;
use Scandinaver\Learn\Domain\Word;
use Scandinaver\User\Domain\User;

/** @var Factory $factory */
$factory->define(\Scandinaver\Learn\Domain\Card::class, function (Faker $faker, array $attributes) {

    $word = entity(Word::class)->create(['language' => $attributes['language']]);

    $translate = entity(\Scandinaver\Learn\Domain\Translate::class)->create(['word' => $word]);

    return [
        'word' => $word,
        'translate' => $translate,
        'asset' => $attributes['asset'] ?? null
    ];
});
