<?php


namespace Tests\Responses;

/**
 * Class Language
 *
 * @package Tests\Responses
 */
class Language implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'title',
            'label',
            'flag',
            'letter',
        ];
    }
}