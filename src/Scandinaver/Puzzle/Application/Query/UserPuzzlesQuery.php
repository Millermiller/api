<?php


namespace Scandinaver\Puzzle\Application\Query;

use Scandinaver\Shared\Contracts\Query;
use Scandinaver\User\Domain\User;

/**
 * Class UserPuzzlesQuery
 * @package Scandinaver\Puzzle\Application\Query
 *
 * @see \Scandinaver\Puzzle\Application\Handlers\UserPuzzlesHandler
 */
class UserPuzzlesQuery implements Query
{
    /**
     * @var User
     */
    private $user;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * UserPuzzlesQuery constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}