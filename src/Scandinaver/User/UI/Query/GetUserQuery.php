<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Model\User;

/**
 * Class GetUserQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\GetUserHandler
 * @package Scandinaver\User\UI\Query
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