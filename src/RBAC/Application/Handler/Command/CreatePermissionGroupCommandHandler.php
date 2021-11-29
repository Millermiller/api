<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupDublicateException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\CreatePermissionGroupCommand;
use Scandinaver\RBAC\UI\Resource\PermissionGroupTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreatePermissionGroupCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreatePermissionGroupCommandHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CreatePermissionGroupCommand  $command
     *
     * @throws PermissionGroupDublicateException
     */
    public function handle(CommandInterface $command): void
    {
        $permissionGroup = $this->service->createPermissionGroup($command->buildDTO());

        $this->resource = new Item($permissionGroup, new PermissionGroupTransformer());
    }
}