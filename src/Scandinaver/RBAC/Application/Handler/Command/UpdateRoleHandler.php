<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\Domain\Exceptions\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\UpdateRoleCommand;
use Scandinaver\RBAC\Domain\Contract\Command\UpdateRoleHandlerInterface;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class UpdateRoleHandler implements UpdateRoleHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  UpdateRoleCommand|Command  $command
     *
     * @throws RoleNotFoundException
     */
    public function handle($command): void
    {
        $this->service->updateRole($command->getId(), $command->getData());
    }
} 