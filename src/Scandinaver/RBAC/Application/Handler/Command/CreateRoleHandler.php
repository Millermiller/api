<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use Scandinaver\RBAC\Domain\Contract\Command\CreateRoleHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\RoleDublicateException;
use Scandinaver\RBAC\Domain\Model\RoleDTO;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\CreateRoleCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateRoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreateRoleHandler implements CreateRoleHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  CreateRoleCommand|Command  $command
     *
     * @return RoleDTO
     * @throws RoleDublicateException
     */
    public function handle($command): RoleDTO
    {
        return $this->service->createRole($command->getData());
    }
} 