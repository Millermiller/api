<?php


namespace Scandinaver\Puzzle\Application\Handlers;

use App\Events\PuzzleCompleted;
use Scandinaver\Puzzle\Application\Commands\PuzzleCompleteCommand;
use Scandinaver\Puzzle\Domain\PuzzleService;

/**
 * Class PuzzleCompletedHandler
 * @package Scandinaver\Puzzle\Application
 */
class PuzzleCompleteHandler implements PuzzleCompleteHandlerInterface
{

    /**
     * @var PuzzleService
     */
    private $puzzleService;

    /**
     * PuzzleCompletedHandler constructor.
     * @param PuzzleService $puzzleService
     */
    public function __construct(PuzzleService $puzzleService)
    {
        $this->puzzleService = $puzzleService;
    }

    /**
     * @param PuzzleCompleteCommand $command
     */
    public function handle($command): void
    {
        $this->puzzleService->completed($command->getUser(), $command->getPuzzle());

        event(new PuzzleCompleted($command->getUser(), $command->getPuzzle()));
    }
}