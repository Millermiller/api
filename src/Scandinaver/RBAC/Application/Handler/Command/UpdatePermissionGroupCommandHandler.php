<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\UpdatePermissionGroupCommand;
use Scandinaver\RBAC\UI\Resource\PermissionGroupTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdatePermissionGroupCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdatePermissionGroupCommandHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdatePermissionGroupCommand|CommandInterface  $command
     *
     * @throws PermissionGroupNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $permissionGroup = $this->service->updatePermissionGroup($command->getId(), $command->getData());

        $this->resource = new Item($permissionGroup, new PermissionGroupTransformer());
    }
} 