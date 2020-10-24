<?php


namespace Scandinaver\Puzzle\Application\Handler\Command;

use App\Events\PuzzleCompleted;
use Scandinaver\Puzzle\Domain\Contract\Command\PuzzleCompleteHandlerInterface;
use Scandinaver\Puzzle\Domain\PuzzleService;
use Scandinaver\Puzzle\UI\Command\PuzzleCompleteCommand;

/**
 * Class PuzzleCompletedHandler
 *
 * @package Scandinaver\Puzzle\Application
 */
class PuzzleCompleteHandler implements PuzzleCompleteHandlerInterface
{
    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  PuzzleCompleteCommand  $command
     */
    public function handle($command): void
    {
        $this->puzzleService->completed($command->getUser(), $command->getPuzzle());
        // event(new PuzzleCompleted($command->getUser(), $command->getPuzzle()));
    }
}