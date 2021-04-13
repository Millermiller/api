<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\RBAC\Domain\Contract\Command\DeleteRoleHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\DeleteRoleCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DeleteRoleHandler extends AbstractHandler implements DeleteRoleHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  DeleteRoleCommand|Command  $command
     *
     * @throws RoleNotFoundException
     */
    public function handle($command): void
    {
        $this->service->deleteRole($command->getId());

        $this->resource = new NullResource();
    }
} 