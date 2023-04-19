<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;
use Scandinaver\RBAC\Application\Handler\Query\PermissionsQueryHandler;

/**
 * Class PermissionsQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 */
#[Handler(PermissionsQueryHandler::class)]
class PermissionsQuery extends FilteringQuery implements QueryInterface
{

}