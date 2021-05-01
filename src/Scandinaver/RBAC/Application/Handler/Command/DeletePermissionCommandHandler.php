<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Exceptions\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\DeletePermissionCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeletePermissionCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DeletePermissionCommandHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  DeletePermissionCommand|CommandInterface  $command
     *
     * @throws PermissionNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->deletePermission($command->getId());

        $this->resource = new NullResource();
    }
} 