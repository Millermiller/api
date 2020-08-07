<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class PlanQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\PlanHandler
 * @package Scandinaver\User\UI\Query
 */
class PlanQuery implements Query
{
    /**
     * @var int
     */
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}