<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

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

    /**
     * @param  PermissionsQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $permissions = $this->service->getAllPermissions();

        $this->fractal->parseIncludes('group');

        $this->resource = new Collection($permissions, new PermissionTransformer());
    }
} 