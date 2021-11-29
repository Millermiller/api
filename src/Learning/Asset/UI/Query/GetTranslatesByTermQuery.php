<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Asset\Application\Handler\Query\GetTranslatesByTermQueryHandler;

/**
 * Class GetTranslatesByTermQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Query(GetTranslatesByTermQueryHandler::class)]
class GetTranslatesByTermQuery implements QueryInterface
{

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}