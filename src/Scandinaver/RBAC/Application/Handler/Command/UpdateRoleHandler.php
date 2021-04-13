<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Contract\Command\UpdateRoleHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\UpdateRoleCommand;
use Scandinaver\RBAC\UI\Resources\RoleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdateRoleHandler extends AbstractHandler implements UpdateRoleHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdateRoleCommand|Command  $command
     *
     * @throws RoleNotFoundException
     */
    public function handle($command): void
    {
        $role = $this->service->updateRole($command->getId(), $command->getData());

        $this->resource = new Item($role, new RoleTransformer());
    }
} 