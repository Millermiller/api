<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class AttachPermissionToRoleCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 *
 * @see     \Scandinaver\RBAC\Application\Handler\Command\AttachPermissionToRoleHandler
 */
class AttachPermissionToRoleCommand implements Command
{
    private int $roleId;

    private int $permissionId;

    public function __construct(int $roleId, int $permissionId)
    {
        $this->roleId       = $roleId;
        $this->permissionId = $permissionId;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function getPermissionId(): int
    {
        return $this->permissionId;
    }
}