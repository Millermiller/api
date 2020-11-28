<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\Domain\Exceptions\PermissionDublicateException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\CreatePermissionCommand;
use Scandinaver\RBAC\Domain\Contract\Command\CreatePermissionHandlerInterface;
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
     * @throws PermissionDublicateException
     */
    public function handle($command): void
    {
        $this->service->createPermission($command->getData());
    }
} 