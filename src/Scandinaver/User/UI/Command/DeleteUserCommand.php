<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeleteUserCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\DeleteUserCommandHandler
 * @package Scandinaver\User\UI\Command
 */
class DeleteUserCommand implements CommandInterface
{
    private int $id;

    public function __construct(int $user)
    {
        $this->id = $user;
    }

    public function getUser(): int
    {
        return $this->id;
    }
}