<?php


namespace Scandinaver\Puzzle\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeletePuzzleCommand
 *
 * @package Scandinaver\Puzzle\UI\Command
 *
 * @see     \Scandinaver\Puzzle\Application\Handler\Command\DeletePuzzleHandler
 */
class DeletePuzzleCommand implements CommandInterface
{
    private int $puzzle;

    public function __construct(int $puzzle)
    {
        $this->puzzle = $puzzle;
    }

    public function getPuzzle(): int
    {
        return $this->puzzle;
    }
}