<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionsQuery;
use Scandinaver\RBAC\UI\Resources\PermissionTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PermissionsQueryHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionsQueryHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  PermissionsQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        $permissions = $this->service->getAllPermissions();

        $this->fractal->parseIncludes('group');

        $this->resource = new Collection($permissions, new PermissionTransformer());
    }
} 