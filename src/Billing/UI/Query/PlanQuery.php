<?php


namespace Scandinaver\Billing\UI\Query;

use Scandinaver\Billing\Application\Handler\Query\PlanQueryHandler;
use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class PlanQuery
 *
 * @package Scandinaver\Billing\UI\Query
 */
#[Query(PlanQueryHandler::class)]
class PlanQuery implements QueryInterface
{

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}