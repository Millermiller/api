<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class AssetsCountQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\AssetsCountHandler
 * @package Scandinaver\Learn\UI\Query
 */
class AssetsCountQuery implements Query
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