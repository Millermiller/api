<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class AudioCountByLanguageQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\AudioCountByLanguageHandler
 * @package Scandinaver\Learn\UI\Query
 */
class AudioCountByLanguageQuery implements Query
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