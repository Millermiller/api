<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class LogoutCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\LogoutHandler
 * @package Scandinaver\User\UI\Command
 */
class LogoutCommand implements Command
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