<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class GetUserQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\GetUserQueryHandler
 * @package Scandinaver\User\UI\Query
 */
class GetUserQuery implements QueryInterface
{

    private UserInterface $user;

    private array $includes;

    public function __construct(UserInterface $user, array $includes = [])
    {
        $this->user = $user;
        $this->includes = $includes;
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