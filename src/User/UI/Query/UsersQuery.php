<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class UsersQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\UsersQueryHandler
 * @package Scandinaver\User\UI\Query
 */
class UsersQuery implements QueryInterface
{

    private array $includes;

    public function __construct(array $includes = [])
    {
        $this->includes = $includes;
    }

    public function getIncludes(): array
    {
        return $this->includes;
    }
}