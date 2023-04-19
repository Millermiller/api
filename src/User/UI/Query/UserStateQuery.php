<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\User\Application\Handler\Query\UsersQueryHandler;

/**
 * Class UserStateQuery
 *
 * @package Scandinaver\User\UI\Query
 */
#[Handler(UsersQueryHandler::class)]
class UserStateQuery implements QueryInterface
{

    public function __construct(private UserInterface $user)
    {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}