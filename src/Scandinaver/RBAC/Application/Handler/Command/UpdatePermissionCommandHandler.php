<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Exception\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\UpdatePermissionCommand;
use Scandinaver\RBAC\UI\Resource\PermissionTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdatePermissionCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdatePermissionCommandHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdatePermissionCommand|CommandInterface  $command
     *
     * @throws PermissionNotFoundException
     * @throws PermissionGroupNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $permission = $this->service->updatePermission($command->getId(), $command->getData());

        $this->fractal->parseIncludes('group');

        $this->resource = new Item($permission, new PermissionTransformer());
    }
} 