<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use Scandinaver\RBAC\UI\Query\PermissionsQuery;
use Scandinaver\RBAC\Domain\Contract\Query\PermissionsHandlerInterface;

/**
 * Class PermissionsHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionsHandler implements PermissionsHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param PermissionsQuery $query
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 