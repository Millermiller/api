<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class WordsCountByLanguageQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\WordsCountByLanguageQueryHandler
 */
class WordsCountByLanguageQuery implements CommandInterface
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