<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use Scandinaver\RBAC\Domain\Exceptions\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Model\Role;
use Scandinaver\RBAC\Domain\Model\RoleDTO;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Query\RoleQuery;
use Scandinaver\RBAC\Domain\Contract\Query\RoleHandlerInterface;
use Scandinaver\Shared\Contract\Query;

/**
 * Class RoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class RoleHandler implements RoleHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  RoleQuery|Query  $query
     *
     * @return RoleDTO
     * @throws RoleNotFoundException
     */
    public function handle($query): RoleDTO
    {
        return $this->service->getRole($query->getId())->toDTO();
    }
} 