<?php


namespace Tests\Responses;


class Language implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'name',
            'label',
            'flag',
            'letter',
            'cardsAvailable',
            'cardsAll',
        ];
    }
}