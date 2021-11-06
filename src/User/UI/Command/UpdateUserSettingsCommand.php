<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;
use Scandinaver\User\Domain\Entity\User;

/**
 * Class UpdateUserSettingsCommand
 *
 * @package Scandinaver\User\UI\Command
 *
 * @see     \Scandinaver\User\Application\Handler\Command\UpdateUserSettingsCommandHandler
 */
class UpdateUserSettingsCommand implements CommandInterface
{

    private UserInterface $user;

    private array $data;

    public function __construct(UserInterface $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}