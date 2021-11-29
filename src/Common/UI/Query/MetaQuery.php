<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Common\Application\Handler\Query\MetaQueryHandler;
use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class MetaQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
#[Query(MetaQueryHandler::class)]
class MetaQuery implements QueryInterface
{

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}