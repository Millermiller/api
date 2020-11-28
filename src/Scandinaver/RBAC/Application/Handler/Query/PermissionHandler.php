<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use Scandinaver\RBAC\UI\Query\PermissionQuery;
use Scandinaver\RBAC\Domain\Contract\Query\PermissionHandlerInterface;

/**
 * Class PermissionHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionHandler implements PermissionHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param PermissionQuery $query
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 