<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Query\RolesQuery;
use Scandinaver\RBAC\UI\Resource\RoleTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class RolesQueryHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class RolesQueryHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    public function handle(BaseCommandInterface|RolesQuery $query): void
    {
        $data = $this->service->getAllRoles($query->getParameters());

        $this->resource = new Collection($data->items(), new RoleTransformer(), 'roles');

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
} 