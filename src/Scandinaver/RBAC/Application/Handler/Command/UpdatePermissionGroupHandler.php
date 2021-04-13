<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Contract\Command\UpdatePermissionGroupHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\UpdatePermissionGroupCommand;
use Scandinaver\RBAC\UI\Resources\PermissionGroupTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdatePermissionGroupHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdatePermissionGroupHandler extends AbstractHandler implements UpdatePermissionGroupHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdatePermissionGroupCommand|Command  $command
     *
     * @throws PermissionGroupNotFoundException
     */
    public function handle($command): void
    {
        $permissionGroup = $this->service->updatePermissionGroup($command->getId(), $command->getData());

        $this->resource = new Item($permissionGroup, new PermissionGroupTransformer());
    }
} 