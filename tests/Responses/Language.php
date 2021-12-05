<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Language
 *
 * @package Tests\Responses
 */
class Language implements ResponseInterface
{

    #[ArrayShape([
        'data' => "array",
    ])]
    public static function singleResponse(): array
    {
        return [
            'data' => [
                'id',
                'type',
                'attributes' => [
                    'title',
                    'description',
                    'letter',
                    'flag',
                    'image',
                    'active',
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
                        'title',
                        'description',
                        'letter',
                        'flag',
                        'image',
                        'active',
                    ],
                ],
            ],
        ];
    }
}