<?php


namespace Tests\Responses;

/**
 * Class Puzzle
 *
 * @package Tests\Responses
 */
class Puzzle implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'text',
            'translate'
        ];
    }
}