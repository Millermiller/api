<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class RoleQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 *
 * @see     \Scandinaver\RBAC\Application\Handler\Query\RoleQueryHandler
 */
class RoleQuery implements QueryInterface
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