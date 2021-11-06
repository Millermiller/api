<?php


namespace Scandinaver\Billing\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class GetOrderQuery
 *
 * @package Scandinaver\Billing\UI\Query
 *
 * @see \Scandinaver\Billing\Application\Handler\Query\GetOrderQueryHandler
 */
class GetOrderQuery implements QueryInterface
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