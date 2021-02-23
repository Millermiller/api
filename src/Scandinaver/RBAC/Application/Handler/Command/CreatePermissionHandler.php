<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\Domain\Contract\Command\CreatePermissionHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\PermissionDublicateException;
use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Model\PermissionDTO;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\CreatePermissionCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreatePermissionHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreatePermissionHandler implements CreatePermissionHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  CreatePermissionCommand|Command  $command
     *
     * @return PermissionDTO
     * @throws PermissionDublicateException
     * @throws PermissionGroupNotFoundException
     */
    public function handle($command): PermissionDTO
    {
        return $this->service->createPermission($command->getData());
    }
} 