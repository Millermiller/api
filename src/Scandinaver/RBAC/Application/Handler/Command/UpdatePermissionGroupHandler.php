<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\RBAC\UI\Command\UpdatePermissionGroupCommand;
use Scandinaver\RBAC\Domain\Contract\Command\UpdatePermissionGroupHandlerInterface;

/**
 * Class UpdatePermissionGroupHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdatePermissionGroupHandler implements UpdatePermissionGroupHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  UpdatePermissionGroupCommand|Command  $command
     *
     * @throws PermissionGroupNotFoundException
     */
    public function handle($command): void
    {
        $this->service->updatePermissionGroup($command->getId(), $command->getData());
    }
} 