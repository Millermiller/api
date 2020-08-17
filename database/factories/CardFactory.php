<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\Result;
use Scandinaver\Learn\Domain\Model\Word;
use Scandinaver\User\Domain\Model\User;

/** @var Factory $factory */
$factory->define(\Scandinaver\Learn\Domain\Model\Card::class, function (Faker $faker, array $attributes) {

    $word = entity(Word::class)->create(['language' => $attributes['language']]);

    $translate = entity(\Scandinaver\Learn\Domain\Model\Translate::class)->create(['word' => $word]);

    return [
        'word' => $word,
        'translate' => $translate,
        'asset' => $attributes['asset'] ?? null
    ];
});
