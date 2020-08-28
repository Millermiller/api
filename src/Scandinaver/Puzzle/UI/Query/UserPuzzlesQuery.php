<?php


namespace Scandinaver\Puzzle\UI\Query;

use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Model\User;

/**
 * Class UserPuzzlesQuery
 *
 * @see     \Scandinaver\Puzzle\Application\Handler\Query\UserPuzzlesHandler
 * @package Scandinaver\Puzzle\UI\Query
 */
class UserPuzzlesQuery implements Query
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