<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class UserQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\UserQueryHandler
 * @package Scandinaver\User\UI\Query
 */
class UserQuery implements QueryInterface
{

    private int $userId;

    private array $includes;

    /**
     * UserQuery constructor.
     *
     * @param  int    $userId
     * @param  array  $includes
     */
    public function __construct(int $userId, array $includes = [])
    {
        $this->userId = $userId;
        $this->includes = $includes;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getIncludes(): array
    {
        return $this->includes;
    }
}