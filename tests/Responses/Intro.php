<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Intro
 *
 * @package Tests\Responses
 */
class Intro implements ResponseInterface
{

    #[ArrayShape(['data' => "array"])]
    public static function response(): array
    {
        return [
            'data' => [
                'id',
                'type',
                'attributes' => [
                    'page',
                    'target',
                    'content',
                    'position',
                    'headerText',
                    'sort',
                ]
            ]

        ];
    }
}