<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionQuery;
use Scandinaver\RBAC\UI\Resource\PermissionTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class PermissionQueryHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionQueryHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  PermissionQuery  $query
     *
     * @throws PermissionNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $permission = $this->service->getPermission($query->getId());

        $this->fractal->parseIncludes('group');

        $this->resource = new Item($permission, new PermissionTransformer());
    }
} 