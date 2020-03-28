<?php


namespace Scandinaver\User\Application\Commands;

use Scandinaver\Shared\Contracts\Command;
use Scandinaver\User\Domain\User;

/**
 * Class DeleteUserCommand
 * @package Scandinaver\User\Application\Commands
 *
 * @see \Scandinaver\User\Application\Handlers\DeleteUserHandler
 */
class DeleteUserCommand implements Command
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