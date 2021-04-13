<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Contract\Command\UpdatePermissionHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Exceptions\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\UpdatePermissionCommand;
use Scandinaver\RBAC\UI\Resources\PermissionTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdatePermissionHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdatePermissionHandler extends AbstractHandler implements UpdatePermissionHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdatePermissionCommand|Command  $command
     *
     * @throws PermissionNotFoundException
     * @throws PermissionGroupNotFoundException
     */
    public function handle($command): void
    {
        $permission = $this->service->updatePermission($command->getId(), $command->getData());

        $this->fractal->parseIncludes('group');

        $this->resource = new Item($permission, new PermissionTransformer());
    }
} 