<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\RBAC\Domain\Contract\Query\PermissionGroupsHandlerInterface;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionGroupsQuery;
use Scandinaver\RBAC\UI\Resources\PermissionGroupTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PermissionGroupsHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionGroupsHandler extends AbstractHandler implements PermissionGroupsHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  PermissionGroupsQuery|Query  $query
     */
    public function handle($query): void
    {
        $permissionGroups = $this->service->getAllPermissionGroups();

        $this->resource = new Collection($permissionGroups, new PermissionGroupTransformer());
    }
} 