<?php


namespace Scandinaver\Puzzle\Application\Handler\Command;

use Scandinaver\Puzzle\Domain\Contract\Command\DeletePuzzleHandlerInterface;
use Scandinaver\Puzzle\Domain\Exception\PuzzleNotFoundException;
use Scandinaver\Puzzle\Domain\PuzzleService;
use Scandinaver\Puzzle\UI\Command\DeletePuzzleCommand;
use Scandinaver\Shared\Contract\Command;

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
     * @param  DeletePuzzleCommand|Command  $command
     *
     * @throws PuzzleNotFoundException
     */
    public function handle($command): void
    {
        $this->puzzleService->delete($command->getPuzzle());
    }
} 