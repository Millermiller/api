<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class PermissionGroupQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 *
 * @see     \Scandinaver\RBAC\Application\Handler\Query\PermissionGroupHandler
 */
class PermissionGroupQuery implements Query
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