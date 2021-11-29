<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\User\Application\Handler\Command\UpdateUserSettingsCommandHandler;

/**
 * Class UpdateUserSettingsCommand
 *
 * @package Scandinaver\User\UI\Command
 */
#[Command(UpdateUserSettingsCommandHandler::class)]
class UpdateUserSettingsCommand implements CommandInterface
{

    public function __construct(private UserInterface $user, private array $data)
    {
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