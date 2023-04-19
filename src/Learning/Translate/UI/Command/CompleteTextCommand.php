<?php


namespace Scandinaver\Learning\Translate\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Translate\Application\Handler\Command\CompleteTextCommandHandler;

/**
 * Class CompleteTextCommand
 *
 * @package Scandinaver\Learning\Translate\UI\Command
 */
#[Handler(CompleteTextCommandHandler::class)]
class CompleteTextCommand implements CommandInterface
{

    public function __construct(private UserInterface $user, private int $text)
    {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getText(): int
    {
        return $this->text;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}