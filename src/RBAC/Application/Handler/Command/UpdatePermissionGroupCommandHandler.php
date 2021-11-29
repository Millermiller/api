<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupDublicateException;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\UpdatePermissionGroupCommand;
use Scandinaver\RBAC\UI\Resource\PermissionGroupTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdatePermissionGroupCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdatePermissionGroupCommandHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  UpdatePermissionGroupCommand  $command
     *
     * @throws PermissionGroupNotFoundException|PermissionGroupDublicateException
     */
    public function handle(CommandInterface $command): void
    {
        $permissionGroup = $this->service->updatePermissionGroup($command->getId(), $command->getData());

        $this->resource = new Item($permissionGroup, new PermissionGroupTransformer());
    }
} 