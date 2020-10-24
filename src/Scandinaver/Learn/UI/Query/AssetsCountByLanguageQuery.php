<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class AssetsCountByLanguageQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\AssetsCountByLanguageHandler
 * @package Scandinaver\Learn\UI\Query
 */
class AssetsCountByLanguageQuery implements Query
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