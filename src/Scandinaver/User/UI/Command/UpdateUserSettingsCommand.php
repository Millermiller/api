<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Class UpdateUserSettingsCommand
 *
 * @package Scandinaver\User\UI\Command
 *
 * @see     \Scandinaver\User\Application\Handler\Command\UpdateUserSettingsCommandHandler
 */
class UpdateUserSettingsCommand implements CommandInterface
{
    private User $user;

    private array $data;

    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getData(): array
    {
        return $this->data;
    }
}