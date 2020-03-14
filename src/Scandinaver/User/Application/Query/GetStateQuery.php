<?php


namespace Scandinaver\User\Application\Query;

use Scandinaver\Shared\Contracts\Query;
use Scandinaver\User\Domain\User;

/**
 * Class GetStateQuery
 * @package Scandinaver\User\Application\Query
 */
class GetStateQuery implements Query
{
    /**
     * @var User
     */
    private $user;

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