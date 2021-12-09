<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionsQuery;
use Scandinaver\RBAC\UI\Resource\PermissionTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class PermissionsQueryHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionsQueryHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    public function handle(BaseCommandInterface|PermissionsQuery $query): void
    {
        $data = $this->service->getAllPermissions($query->getParameters());

        $this->fractal->parseIncludes('group');

        $this->resource = new Collection($data->items(), new PermissionTransformer(), 'permissions');

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
} 