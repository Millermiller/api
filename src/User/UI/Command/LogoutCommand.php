<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\User\Application\Handler\Command\LogoutCommandHandler;

/**
 * Class LogoutCommand
 *
 * @package Scandinaver\User\UI\Command
 */
#[Handler(LogoutCommandHandler::class)]
class LogoutCommand implements CommandInterface
{

    public function __construct(private UserInterface $user)
    {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}