<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class SearchCardQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\SearchCardHandler
 */
class SearchCardQuery implements Query
{
    private string $language;

    private ?string $query;

    private int $isSentence;

    public function __construct(array $data)
    {
        $this->language   = $data['lang'];
        $this->query      = $data['query'];
        $this->isSentence = (bool)$data['sentence'];
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getIsSentence(): int
    {
        return $this->isSentence;
    }
}