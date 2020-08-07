<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class DeleteUserCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\DeleteUserHandler
 * @package Scandinaver\User\UI\Command
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