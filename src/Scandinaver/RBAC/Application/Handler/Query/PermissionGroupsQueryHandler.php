<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionGroupsQuery;
use Scandinaver\RBAC\UI\Resource\PermissionGroupTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PermissionGroupsQueryHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionGroupsQueryHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  PermissionGroupsQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        $permissionGroups = $this->service->getAllPermissionGroups();

        $this->resource = new Collection($permissionGroups, new PermissionGroupTransformer());
    }
} 