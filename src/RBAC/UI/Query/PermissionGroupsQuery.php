<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;
use Scandinaver\RBAC\Application\Handler\Query\PermissionGroupsQueryHandler;

/**
 * Class PermissionGroupsQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 */
#[Query(PermissionGroupsQueryHandler::class)]
class PermissionGroupsQuery extends FilteringQuery implements QueryInterface
{

}