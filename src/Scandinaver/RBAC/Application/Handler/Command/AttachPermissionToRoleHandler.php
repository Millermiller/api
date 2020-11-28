<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\AttachPermissionToRoleCommand;
use Scandinaver\RBAC\Domain\Contract\Command\AttachPermissionToRoleHandlerInterface;
use Scandinaver\Shared\Contract\Command;

/**
 * Class AttachPermissionToRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class AttachPermissionToRoleHandler implements AttachPermissionToRoleHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param AttachPermissionToRoleCommand|Command $command
     */
    public function handle($command): void
    {
        $this->service->attachPermissionToRole($command->getRoleId(), $command->getPermissionId());
    }
} 