<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Model\User;

/**
 * Class UserStateQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\UserStateHandler
 * @package Scandinaver\User\UI\Query
 */
class UserStateQuery implements Query
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}