<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Exception\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Exception\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\DetachPermissionFromRoleCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DetachPermissionFromRoleCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DetachPermissionFromRoleCommandHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|DetachPermissionFromRoleCommand  $command
     *
     * @throws PermissionNotFoundException
     * @throws RoleNotFoundException
     */
    public function handle(CommandInterface|DetachPermissionFromRoleCommand $command): void
    {
        $this->service->detachPermissionFromRole($command->getRoleId(), $command->getPermissionId());

        $this->resource = new NullResource();
    }
} 