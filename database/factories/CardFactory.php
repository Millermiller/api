<?php

use Doctrine\Common\Collections\ArrayCollection;
use Faker\Generator as Faker;
use LaravelDoctrine\ORM\Testing\Factory;
use Scandinaver\Learn\Domain\Entity\Card;
use Scandinaver\Learn\Domain\Entity\Example;
use Scandinaver\Learn\Domain\Entity\Term;
use Scandinaver\Learn\Domain\Entity\Translate;

/** @var Factory $factory */
$factory->define(Card::class, function (Faker $faker, array $attributes) {

    /** @var Term $term */
    $term = entity(Term::class)->create([
        'language' => $attributes['language'],
        'creator' => null
    ]);

    $translate = entity(Translate::class)->create(['word' => $term]);

    $example = entity(Example::class)->create();

    return [
        'term' => $term,
        'translate' => $translate,
        'asset' => $attributes['asset'] ?? null,
        'examples' => new ArrayCollection([$example])
    ];
});
