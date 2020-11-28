<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class PermissionQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 *
 * @see \Scandinaver\RBAC\Application\Handler\Query\PermissionHandler
 */
class PermissionQuery implements Query
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