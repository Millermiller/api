<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PermissionGroupQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 *
 * @see     \Scandinaver\RBAC\Application\Handler\Query\PermissionGroupQueryHandler
 */
class PermissionGroupQuery implements CommandInterface
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