<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Contract\Command\CreatePermissionGroupHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupDublicateException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\CreatePermissionGroupCommand;
use Scandinaver\RBAC\UI\Resources\PermissionGroupTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreatePermissionGroupHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreatePermissionGroupHandler extends AbstractHandler implements CreatePermissionGroupHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CreatePermissionGroupCommand|Command  $command
     *
     * @throws PermissionGroupDublicateException
     */
    public function handle($command): void
    {
        $permissionGroup = $this->service->createPermissionGroup($command->getData());

        $this->resource = new Item($permissionGroup, new PermissionGroupTransformer());
    }
}