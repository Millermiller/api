<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\RoleDublicateException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\CreateRoleCommand;
use Scandinaver\RBAC\UI\Resource\RoleTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateRoleCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreateRoleCommandHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CreateRoleCommand  $command
     *
     * @throws RoleDublicateException
     */
    public function handle(CommandInterface $command): void
    {
        $role = $this->service->createRole($command->buildDTO());

        $this->resource = new Item($role, new RoleTransformer());
    }
} 