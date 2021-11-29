<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class LanguageCollection
 *
 * @package Tests\Responses
 */
class LanguageCollection implements ResponseInterface
{

    #[ArrayShape([
        'data' => "array[]",
    ])]
    public static function response(): array
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