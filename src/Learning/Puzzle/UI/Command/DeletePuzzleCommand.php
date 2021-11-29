<?php


namespace Scandinaver\Learning\Puzzle\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Puzzle\Application\Handler\Command\DeletePuzzleCommandHandler;

/**
 * Class DeletePuzzleCommand
 *
 * @package Scandinaver\Puzzle\UI\Command
 */
#[Command(DeletePuzzleCommandHandler::class)]
class DeletePuzzleCommand implements CommandInterface
{

    public function __construct(private int $puzzle)
    {
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