<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\User\Application\Handler\Command\DeleteUserCommandHandler;

/**
 * Class DeleteUserCommand
 *
 * @package Scandinaver\User\UI\Command
 */
#[Command(DeleteUserCommandHandler::class)]
class DeleteUserCommand implements CommandInterface
{


    public function __construct(private int $id)
    {

    }

    public function getUser(): int
    {
        return $this->id;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}