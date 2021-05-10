<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class AudioCountByLanguageQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\AudioCountByLanguageQueryHandler
 */
class AudioCountByLanguageQuery implements QueryInterface
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