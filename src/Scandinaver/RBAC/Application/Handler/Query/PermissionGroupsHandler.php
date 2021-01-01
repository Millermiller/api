<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\RBAC\UI\Query\PermissionGroupsQuery;
use Scandinaver\RBAC\Domain\Contract\Query\PermissionGroupsHandlerInterface;

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
    public function handle($query)
    {
        return $this->service->getAllPermissionGroups();
    }
} 