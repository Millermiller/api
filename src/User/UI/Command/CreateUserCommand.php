<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\User\Application\Handler\Command\CreateUserCommandHandler;
use Scandinaver\User\Domain\DTO\UserDTO;

/**
 * Class CreateUserCommand
 *
 * @package Scandinaver\User\UI\Command
 */
#[Command(CreateUserCommandHandler::class)]
class CreateUserCommand implements CommandInterface
{

    public function __construct(private array $data)
    {
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function buildDTO(): UserDTO
    {
        return UserDTO::fromArray($this->data);
    }
}