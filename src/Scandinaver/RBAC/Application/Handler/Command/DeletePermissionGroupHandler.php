<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Contract\Command\DeletePermissionGroupHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\DeletePermissionGroupCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeletePermissionGroupHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DeletePermissionGroupHandler extends AbstractHandler implements DeletePermissionGroupHandlerInterface
{
    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

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

        $this->resource = new NullResource();
    }
} 