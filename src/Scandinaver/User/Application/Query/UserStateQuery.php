<?php


namespace Scandinaver\User\Application\Query;

use Scandinaver\Shared\Contracts\Query;
use Scandinaver\User\Domain\User;

/**
 * Class UserStateQuery
 * @package Scandinaver\User\Application\Query
 *
 * @see \Scandinaver\User\Application\Handlers\UserStateHandler
 */
class UserStateQuery implements Query
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserStateQuery constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}