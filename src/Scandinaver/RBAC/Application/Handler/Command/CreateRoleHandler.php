<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Contract\Command\CreateRoleHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\RoleDublicateException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\CreateRoleCommand;
use Scandinaver\RBAC\UI\Resources\RoleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreateRoleHandler extends AbstractHandler implements CreateRoleHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CreateRoleCommand|Command  $command
     *
     * @throws RoleDublicateException
     */
    public function handle($command): void
    {
        $role = $this->service->createRole($command->getData());

        $this->resource = new Item($role, new RoleTransformer());
    }
} 