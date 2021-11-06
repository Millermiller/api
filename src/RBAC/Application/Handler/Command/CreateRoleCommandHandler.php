<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\RoleDublicateException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\CreateRoleCommand;
use Scandinaver\RBAC\UI\Resource\RoleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CreateRoleCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreateRoleCommandHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CreateRoleCommand|BaseCommandInterface  $command
     *
     * @throws RoleDublicateException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $role = $this->service->createRole($command->buildDTO());

        $this->resource = new Item($role, new RoleTransformer());
    }
} 