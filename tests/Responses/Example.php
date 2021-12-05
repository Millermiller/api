<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Example
 *
 * @package Tests\Responses
 */
class Example implements ResponseInterface
{

    #[ArrayShape(['data' => "array"])]
    public static function singleResponse(): array
    {
        return [
            'data' => [
                'id',
                'type',
                'attributes' => [
                    'text',
                    'value',
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
                        'value',
                    ],
                ],
            ],
        ];
    }
}