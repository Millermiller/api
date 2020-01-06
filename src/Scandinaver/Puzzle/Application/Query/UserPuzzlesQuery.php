<?php


namespace Scandinaver\Puzzle\Application\Query;

use App\Entities\User;
use Scandinaver\Shared\Query;

/**
 * Class UserPuzzlesQuery
 * @package Scandinaver\Puzzle\Application\Query
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