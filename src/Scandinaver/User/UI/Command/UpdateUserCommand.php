<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class UpdateUserCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\UpdateUserHandler
 * @package Scandinaver\User\UI\Command
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