<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\Domain\Contract\Command\DetachPermissionFromRoleHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Exceptions\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\DetachPermissionFromRoleCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DetachPermissionFromRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DetachPermissionFromRoleHandler implements DetachPermissionFromRoleHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  DetachPermissionFromRoleCommand|Command  $command
     *
     * @throws PermissionNotFoundException
     * @throws RoleNotFoundException
     */
    public function handle($command): void
    {
        $this->service->detachPermissionFromRole($command->getRoleId(), $command->getPermissionId());
    }
} 