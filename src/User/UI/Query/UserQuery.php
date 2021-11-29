<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\User\Application\Handler\Query\UserQueryHandler;

/**
 * Class UserQuery
 *
 * @package Scandinaver\User\UI\Query
 */
#[Query(UserQueryHandler::class)]
class UserQuery implements QueryInterface
{

    public function __construct(private int $userId, private array $includes = [])
    {
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