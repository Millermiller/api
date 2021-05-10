<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupDublicateException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\CreatePermissionGroupCommand;
use Scandinaver\RBAC\UI\Resource\PermissionGroupTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CreatePermissionGroupCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreatePermissionGroupCommandHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CreatePermissionGroupCommand|BaseCommandInterface  $command
     *
     * @throws PermissionGroupDublicateException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $permissionGroup = $this->service->createPermissionGroup($command->buildDTO());

        $this->resource = new Item($permissionGroup, new PermissionGroupTransformer());
    }
}