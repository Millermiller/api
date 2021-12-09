<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Query\RoleQuery;
use Scandinaver\RBAC\UI\Resource\RoleTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class RoleQueryHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class RoleQueryHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|RoleQuery  $query
     *
     * @throws RoleNotFoundException
     */
    public function handle(BaseCommandInterface|RoleQuery $query): void
    {
        $role = $this->service->getRole($query->getId());

        $this->resource = new Item($role, new RoleTransformer());
    }
} 