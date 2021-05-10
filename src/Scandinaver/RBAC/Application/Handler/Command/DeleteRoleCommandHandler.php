<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Exception\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\DeleteRoleCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class DeleteRoleCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DeleteRoleCommandHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  DeleteRoleCommand|BaseCommandInterface  $command
     *
     * @throws RoleNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->service->deleteRole($command->getId());

        $this->resource = new NullResource();
    }
} 