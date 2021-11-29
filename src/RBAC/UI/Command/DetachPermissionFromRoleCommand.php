<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\RBAC\Application\Handler\Command\DetachPermissionFromRoleCommandHandler;

/**
 * Class DetachPermissionFromRoleCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 */
#[Command(DetachPermissionFromRoleCommandHandler::class)]
class DetachPermissionFromRoleCommand implements CommandInterface
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

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}