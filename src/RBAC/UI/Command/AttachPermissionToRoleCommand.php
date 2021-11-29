<?php


namespace Scandinaver\RBAC\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\RBAC\Application\Handler\Command\AttachPermissionToRoleCommandHandler;

/**
 * Class AttachPermissionToRoleCommand
 *
 * @package Scandinaver\RBAC\UI\Command
 */
#[Command(AttachPermissionToRoleCommandHandler::class)]
class AttachPermissionToRoleCommand implements CommandInterface
{

    public function __construct(private int $roleId, private int $permissionId)
    {
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