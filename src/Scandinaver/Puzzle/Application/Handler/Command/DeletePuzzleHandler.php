<?php


namespace Scandinaver\Puzzle\Application\Handler\Command;

use Scandinaver\Puzzle\Domain\PuzzleService;
use Scandinaver\Puzzle\UI\Command\DeletePuzzleCommand;
use Scandinaver\Puzzle\Domain\Contract\Command\DeletePuzzleHandlerInterface;

/**
 * Class DeletePuzzleHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Command
 */
class DeletePuzzleHandler implements DeletePuzzleHandlerInterface
{
    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  DeletePuzzleCommand  $command
     */
    public function handle($command): void
    {
        $this->puzzleService->delete($command->getPuzzle());
    }
} 