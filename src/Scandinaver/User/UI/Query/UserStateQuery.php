<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UserStateQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\UserStateQueryHandler
 * @package Scandinaver\User\UI\Query
 */
class UserStateQuery implements CommandInterface
{
    private UserInterface $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}