<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Exceptions\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Exceptions\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\DetachPermissionFromRoleCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DetachPermissionFromRoleCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DetachPermissionFromRoleCommandHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  DetachPermissionFromRoleCommand|CommandInterface  $command
     *
     * @throws PermissionNotFoundException
     * @throws RoleNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->detachPermissionFromRole($command->getRoleId(), $command->getPermissionId());

        $this->resource = new NullResource();
    }
} 