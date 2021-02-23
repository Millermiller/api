<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\Domain\Contract\Command\DeleteRoleHandlerInterface;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\DeleteRoleCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class DeleteRoleHandler implements DeleteRoleHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  DeleteRoleCommand|Command  $command
     */
    public function handle($command): void
    {
        $this->service->deleteRole($command->getId());
    }
} 