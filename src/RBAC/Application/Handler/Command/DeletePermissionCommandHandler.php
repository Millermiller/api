<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Exception\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\DeletePermissionCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param  DeletePermissionCommand|BaseCommandInterface  $command
     *
     * @throws PermissionNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->service->deletePermission($command->getId());

        $this->resource = new NullResource();
    }
} 