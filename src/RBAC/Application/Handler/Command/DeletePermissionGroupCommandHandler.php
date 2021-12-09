<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\DeletePermissionGroupCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeletePermissionGroupCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DeletePermissionGroupCommandHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|DeletePermissionGroupCommand  $command
     *
     * @throws PermissionGroupNotFoundException
     */
    public function handle(CommandInterface|DeletePermissionGroupCommand $command): void
    {
        $this->service->deletePermissionGroup($command->getId());

        $this->resource = new NullResource();
    }
} 