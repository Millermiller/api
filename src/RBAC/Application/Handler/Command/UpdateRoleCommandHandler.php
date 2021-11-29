<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\UpdateRoleCommand;
use Scandinaver\RBAC\UI\Resource\RoleTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateRoleCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdateRoleCommandHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  UpdateRoleCommand  $command
     *
     * @throws RoleNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $role = $this->service->updateRole($command->getId(), $command->getData());

        $this->resource = new Item($role, new RoleTransformer());
    }
} 