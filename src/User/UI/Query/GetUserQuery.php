<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\User\Application\Handler\Query\GetUserQueryHandler;

/**
 * Class GetUserQuery
 *
 * @package Scandinaver\User\UI\Query
 */
#[Query(GetUserQueryHandler::class)]
class GetUserQuery implements QueryInterface
{

    public function __construct(private UserInterface $user, private array $includes = [])
    {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getIncludes(): array
    {
        return $this->includes;
    }
}