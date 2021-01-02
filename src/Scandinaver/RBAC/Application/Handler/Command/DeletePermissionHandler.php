<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\DeletePermissionCommand;
use Scandinaver\RBAC\Domain\Contract\Command\DeletePermissionHandlerInterface;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeletePermissionHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DeletePermissionHandler implements DeletePermissionHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param DeletePermissionCommand|Command $command
     */
    public function handle($command): void
    {
        $this->service->deletePermission($command->getId());
    }
} 