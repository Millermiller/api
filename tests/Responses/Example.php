<?php


namespace Tests\Responses;

/**
 * Class Example
 *
 * @package Tests\Responses
 */
class Example implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'text',
            'value',
        ];
    }
}