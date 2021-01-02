<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\Domain\Contract\Command\CreatePermissionGroupHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupDublicateException;
use Scandinaver\RBAC\Domain\Model\PermissionGroupDTO;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\CreatePermissionGroupCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreatePermissionGroupHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreatePermissionGroupHandler implements CreatePermissionGroupHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  CreatePermissionGroupCommand|Command  $command
     *
     * @return PermissionGroupDTO
     * @throws PermissionGroupDublicateException
     */
    public function handle($command): PermissionGroupDTO
    {
        return $this->service->createPermissionGroup($command->getData());
    }

}