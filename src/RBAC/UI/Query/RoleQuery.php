<?php


namespace Scandinaver\RBAC\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\RBAC\Application\Handler\Query\RoleQueryHandler;

/**
 * Class RoleQuery
 *
 * @package Scandinaver\RBAC\UI\Query
 */
#[Handler(RoleQueryHandler::class)]
class RoleQuery implements QueryInterface
{

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}