<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Exception\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Exception\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\AttachPermissionToRoleCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class AttachPermissionToRoleCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class AttachPermissionToRoleCommandHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  AttachPermissionToRoleCommand|CommandInterface  $command
     *
     * @throws PermissionNotFoundException
     * @throws RoleNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->attachPermissionToRole($command->getRoleId(), $command->getPermissionId());

        $this->resource = new NullResource();
    }
} 