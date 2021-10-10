<?php


namespace Scandinaver\Billing\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class PlanQuery
 *
 * @see     \Scandinaver\Billing\Application\Handler\Query\PlanQueryHandler
 * @package Scandinaver\Billing\UI\Query
 */
class PlanQuery implements QueryInterface
{

    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}