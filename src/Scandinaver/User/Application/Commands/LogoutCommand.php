<?php


namespace Scandinaver\User\Application\Commands;

use Scandinaver\Shared\Contracts\Command;
use Scandinaver\User\Domain\User;

/**
 * Class LogoutCommand
 * @package Scandinaver\User\Application\Commands
 *
 * @see \Scandinaver\User\Application\Handlers\LogoutHandler
 */
class LogoutCommand implements Command
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