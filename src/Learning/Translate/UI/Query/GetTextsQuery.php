<?php


namespace Scandinaver\Learning\Translate\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class GetTextsQuery
 *
 * @package Scandinaver\Translate\UI\Query
 *
 * @see     \Scandinaver\Translate\Application\Handler\Query\GetTextsQueryHandler
 */
class GetTextsQuery implements QueryInterface
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