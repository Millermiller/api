<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Exception\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\DeleteRoleCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

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
     * @param  DeleteRoleCommand|CommandInterface  $command
     *
     * @throws RoleNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->deleteRole($command->getId());

        $this->resource = new NullResource();
    }
} 