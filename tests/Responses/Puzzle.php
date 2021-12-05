<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Puzzle
 *
 * @package Tests\Responses
 */
class Puzzle implements ResponseInterface
{

    #[ArrayShape([
        'data' => "array[]",
    ])]
    public static function singleResponse(): array
    {
        return [
            'data' => [
                'id',
                'type',
                'attributes' => [
                    'text',
                    'translate',
                ],
            ],
        ];
    }

    #[ArrayShape(['data' => "array[]"])]
    public static function collectionResponse(): array
    {
        return [
            'data' => [
                '*' => [
                    'id',
                    'type',
                    'attributes' => [
                        'text',
                        'translate',
                    ],
                ],
            ],
        ];
    }
}