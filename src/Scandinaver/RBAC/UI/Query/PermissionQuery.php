<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PermissionQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 *
 * @see     \Scandinaver\RBAC\Application\Handler\Query\PermissionQueryHandler
 */
class PermissionQuery implements CommandInterface
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