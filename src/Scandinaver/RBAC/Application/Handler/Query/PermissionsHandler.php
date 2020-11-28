<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionsQuery;
use Scandinaver\RBAC\Domain\Contract\Query\PermissionsHandlerInterface;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PermissionsHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionsHandler implements PermissionsHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  PermissionsQuery|Query  $query
     *
     * @return array
     */
    public function handle($query): array
    {
       return $this->service->getAllPermissions();
    }
} 