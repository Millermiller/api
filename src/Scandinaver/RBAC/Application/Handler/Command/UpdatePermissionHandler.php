<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Exceptions\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Model\PermissionDTO;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\UpdatePermissionCommand;
use Scandinaver\RBAC\Domain\Contract\Command\UpdatePermissionHandlerInterface;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdatePermissionHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdatePermissionHandler implements UpdatePermissionHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  UpdatePermissionCommand|Command  $command
     *
     * @return PermissionDTO
     * @throws PermissionNotFoundException
     * @throws PermissionGroupNotFoundException
     */
    public function handle($command): PermissionDTO
    {
        return $this->service->updatePermission($command->getId(), $command->getData());
    }
} 