<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class LogoutCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\LogoutCommandHandler
 * @package Scandinaver\User\UI\Command
 */
class LogoutCommand implements CommandInterface
{

    private UserInterface $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
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