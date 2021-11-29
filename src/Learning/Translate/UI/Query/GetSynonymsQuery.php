<?php


namespace Scandinaver\Learning\Translate\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Translate\Application\Handler\Query\GetSynonymsQueryHandler;

/**
 * Class GetSynonymsQuery
 *
 * @package Scandinaver\Learning\Translate\UI\Query
 */
#[Query(GetSynonymsQueryHandler::class)]
class GetSynonymsQuery implements QueryInterface
{

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}