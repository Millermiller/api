<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteUserCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\DeleteUserHandler
 * @package Scandinaver\User\UI\Command
 */
class DeleteUserCommand implements Command
{
    private int $user;

    public function __construct(int $user)
    {
        $this->user = $user;
    }

    public function getUser(): int
    {
        return $this->user;
    }
}