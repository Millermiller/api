<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\UpdateRoleCommand;
use Scandinaver\RBAC\UI\Resource\RoleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateRoleCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdateRoleCommandHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdateRoleCommand|CommandInterface  $command
     *
     * @throws RoleNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $role = $this->service->updateRole($command->getId(), $command->getData());

        $this->resource = new Item($role, new RoleTransformer());
    }
} 