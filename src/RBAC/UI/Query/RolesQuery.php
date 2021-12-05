<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;
use Scandinaver\RBAC\Application\Handler\Query\RolesQueryHandler;

/**
 * Class RolesQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 */
#[Query(RolesQueryHandler::class)]
class RolesQuery extends FilteringQuery implements QueryInterface
{

}