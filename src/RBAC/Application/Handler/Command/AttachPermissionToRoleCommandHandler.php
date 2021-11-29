<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Exception\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Exception\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\AttachPermissionToRoleCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class AttachPermissionToRoleCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class AttachPermissionToRoleCommandHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  AttachPermissionToRoleCommand  $command
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