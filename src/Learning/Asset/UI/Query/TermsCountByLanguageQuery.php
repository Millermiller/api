<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class TermCountByLanguageQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\TermsCountByLanguageQueryHandler
 */
class TermsCountByLanguageQuery implements QueryInterface
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