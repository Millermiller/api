<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionGroupsQuery;
use Scandinaver\RBAC\UI\Resource\PermissionGroupTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class PermissionGroupsQueryHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionGroupsQueryHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  PermissionGroupsQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $permissionGroups = $this->service->getAllPermissionGroups();

        $this->resource = new Collection($permissionGroups, new PermissionGroupTransformer());
    }
} 