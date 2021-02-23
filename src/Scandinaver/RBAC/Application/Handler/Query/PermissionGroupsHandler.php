<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use Scandinaver\RBAC\Domain\Contract\Query\PermissionGroupsHandlerInterface;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionGroupsQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PermissionGroupsHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionGroupsHandler implements PermissionGroupsHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  PermissionGroupsQuery|Query  $query
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->service->getAllPermissionGroups();
    }
} 