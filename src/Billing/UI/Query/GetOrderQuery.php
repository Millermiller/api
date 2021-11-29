<?php


namespace Scandinaver\Billing\UI\Query;

use Scandinaver\Billing\Application\Handler\Query\GetOrderQueryHandler;
use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class GetOrderQuery
 *
 * @package Scandinaver\Billing\UI\Query
 */
#[Query(GetOrderQueryHandler::class)]
class GetOrderQuery implements QueryInterface
{

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}