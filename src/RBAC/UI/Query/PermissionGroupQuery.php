<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\RBAC\Application\Handler\Query\PermissionGroupQueryHandler;

/**
 * Class PermissionGroupQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 */
#[Handler(PermissionGroupQueryHandler::class)]
class PermissionGroupQuery implements QueryInterface
{

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}