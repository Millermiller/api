<?php


namespace Scandinaver\User\Application\Commands;

use Scandinaver\Shared\Contracts\Command;
use Scandinaver\User\Domain\User;

/**
 * Class UpdateUserCommand
 *
 * @package Scandinaver\User\Application\Commands
 * @see     \Scandinaver\User\Application\Handlers\UpdateUserHandler
 */
class UpdateUserCommand implements Command
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var array
     */
    private $data;

    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}