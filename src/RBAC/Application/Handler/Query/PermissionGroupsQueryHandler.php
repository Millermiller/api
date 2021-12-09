<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
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

    public function handle(BaseCommandInterface|PermissionGroupsQuery $query): void
    {
        $data = $this->service->getAllPermissionGroups($query->getParameters());

        $this->resource = new Collection($data->items(), new PermissionGroupTransformer(), 'permissionGroup');

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
} 