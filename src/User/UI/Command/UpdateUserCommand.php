<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\User\Application\Handler\Command\UpdateUserCommandHandler;

/**
 * Class UpdateUserCommand
 *
 * @package Scandinaver\User\UI\Command
 */
#[Command(UpdateUserCommandHandler::class)]
class UpdateUserCommand implements CommandInterface
{

    public function __construct(private int $user, private array $data)
    {
    }

    public function getUser(): int
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