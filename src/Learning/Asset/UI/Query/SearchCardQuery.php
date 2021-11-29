<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Asset\Application\Handler\Query\SearchCardQueryHandler;

/**
 * Class SearchCardQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Query(SearchCardQueryHandler::class)]
class SearchCardQuery implements QueryInterface
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