<?php


namespace Scandinaver\Learning\Translate\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Translate\Application\Handler\Query\GetTextsQueryHandler;

/**
 * Class GetTextsQuery
 *
 * @package Scandinaver\Learning\Translate\UI\Query
 */
#[Query(GetTextsQueryHandler::class)]
class GetTextsQuery implements QueryInterface
{

    public function __construct(private string $language)
    {
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}