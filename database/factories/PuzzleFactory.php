<?php

use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learning\Puzzle\Domain\Entity\Puzzle;
use Scandinaver\Learning\Puzzle\Domain\Entity\PuzzleText;
use Scandinaver\Learning\Puzzle\Domain\Entity\PuzzleTranslate;

/** @var Factory $factory */
$factory->define(Puzzle::class, function (Faker $faker, array $attributes) {

    return [
        'text' => new PuzzleText($faker->unique()->text(10)),
        'translate' => new PuzzleTranslate($faker->unique()->text(10)),
        'language' => $attributes['language']
    ];
});
