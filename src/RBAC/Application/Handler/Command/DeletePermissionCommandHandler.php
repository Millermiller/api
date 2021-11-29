<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Exception\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\DeletePermissionCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeletePermissionCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DeletePermissionCommandHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  DeletePermissionCommand  $command
     *
     * @throws PermissionNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->deletePermission($command->getId());

        $this->resource = new NullResource();
    }
} 