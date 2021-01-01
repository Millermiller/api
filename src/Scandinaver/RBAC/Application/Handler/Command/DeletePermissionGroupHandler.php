<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\RBAC\UI\Command\DeletePermissionGroupCommand;
use Scandinaver\RBAC\Domain\Contract\Command\DeletePermissionGroupHandlerInterface;

/**
 * Class DeletePermissionGroupHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DeletePermissionGroupHandler implements DeletePermissionGroupHandlerInterface
{
    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  DeletePermissionGroupCommand|Command  $command
     *
     * @throws PermissionGroupNotFoundException
     */
    public function handle($command): void
    {
        $this->service->deletePermissionGroup($command->getId());
    }
} 