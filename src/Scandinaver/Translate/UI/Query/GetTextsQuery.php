<?php


namespace Scandinaver\Translate\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class GetTextsQuery
 *
 * @package Scandinaver\Translate\UI\Query
 *
 * @see     \Scandinaver\Translate\Application\Handler\Query\GetTextsHandler
 */
class GetTextsQuery implements Query
{
    private string $language;

    public function __construct(string $language)
    {
        $this->language = $language;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}