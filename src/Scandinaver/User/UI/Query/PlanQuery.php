<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PlanQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\PlanQueryHandler
 * @package Scandinaver\User\UI\Query
 */
class PlanQuery implements CommandInterface
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