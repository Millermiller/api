<?php


namespace Scandinaver\User\Application\Query;

use Scandinaver\Shared\Contracts\Query;

/**
 * Class PlanQuery
 * @package Scandinaver\User\Application\Query
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