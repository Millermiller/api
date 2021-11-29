<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class IntroCollection
 *
 * @package Tests\Responses
 */
class IntroCollection implements ResponseInterface
{

    #[ArrayShape(['data' => "array"])]
    public static function response(): array
    {
        return [
            'data' => [
                '*' => [
                    'id',
                    'type',
                    'attributes' => [
                        'page',
                        'target',
                        'content',
                        'position',
                        'headerText',
                        'sort',
                    ],
                ],
            ],

        ];
    }
}