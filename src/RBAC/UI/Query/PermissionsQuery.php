<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\RBAC\Application\Handler\Query\PermissionsQueryHandler;

/**
 * Class PermissionsQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 */
#[Query(PermissionsQueryHandler::class)]
class PermissionsQuery implements QueryInterface
{

    public function __construct()
    {

    }
}