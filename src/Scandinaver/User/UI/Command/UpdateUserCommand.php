<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateUserCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\UpdateUserCommandHandler
 * @package Scandinaver\User\UI\Command
 */
class UpdateUserCommand implements CommandInterface
{
    private int $user;

    private array $data;

    public function __construct(int $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function getUser(): int
    {
        return $this->user;
    }

    public function getData(): array
    {
        return $this->data;
    }
}