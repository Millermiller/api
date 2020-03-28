<?php


namespace Scandinaver\User\Application\Query;

use Scandinaver\Shared\Contracts\Query;
use Scandinaver\User\Domain\User;

/**
 * Class GetUserQuery
 * @package Scandinaver\User\Application\Query
 *
 * @see \Scandinaver\User\Application\Handlers\GetUserHandler
 */
class GetUserQuery implements Query
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}