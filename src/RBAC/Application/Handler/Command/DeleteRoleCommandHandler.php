<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Exception\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\DeleteRoleCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeleteRoleCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DeleteRoleCommandHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|DeleteRoleCommand  $command
     *
     * @throws RoleNotFoundException
     */
    public function handle(CommandInterface|DeleteRoleCommand $command): void
    {
        $this->service->deleteRole($command->getId());

        $this->resource = new NullResource();
    }
} 