<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;
use Scandinaver\RBAC\Application\Handler\Query\PermissionGroupsQueryHandler;

/**
 * Class PermissionGroupsQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 */
#[Handler(PermissionGroupsQueryHandler::class)]
class PermissionGroupsQuery extends FilteringQuery implements QueryInterface
{

}