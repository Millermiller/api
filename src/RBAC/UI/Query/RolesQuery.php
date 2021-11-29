<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\RBAC\Application\Handler\Query\RolesQueryHandler;

/**
 * Class RolesQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 */
#[Query(RolesQueryHandler::class)]
class RolesQuery implements QueryInterface
{

    public function __construct()
    {

    }
}