<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Model\PermissionGroupDTO;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\RBAC\UI\Query\PermissionGroupQuery;
use Scandinaver\RBAC\Domain\Contract\Query\PermissionGroupHandlerInterface;

/**
 * Class PermissionGroupHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionGroupHandler implements PermissionGroupHandlerInterface
{
    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  PermissionGroupQuery|Query  $query
     *
     * @return PermissionGroupDTO
     * @throws PermissionGroupNotFoundException
     */
    public function handle($query): PermissionGroupDTO
    {
        return $this->service->getPermissionGroup($query->getId())->toDTO();
    }
} 