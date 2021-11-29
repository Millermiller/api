<?php


namespace Scandinaver\Learning\Puzzle\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Puzzle\Application\Handler\Command\PuzzleCompleteCommandHandler;

/**
 * Class PuzzleCompleteCommand
 *
 * @package Scandinaver\Puzzle\Application\Command
 */
#[Command(PuzzleCompleteCommandHandler::class)]
class PuzzleCompleteCommand implements CommandInterface
{

    public function __construct(private UserInterface $user, private int $puzzle)
    {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getPuzzle(): int
    {
        return $this->puzzle;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}