<?php


namespace Scandinaver\Puzzle\Application\Handler\Command;

use Scandinaver\Puzzle\Domain\Contract\Command\PuzzleCompleteHandlerInterface;
use Scandinaver\Puzzle\Domain\PuzzleService;
use Scandinaver\Puzzle\UI\Command\PuzzleCompleteCommand;
use Scandinaver\Shared\Contract\Command;

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
     * @param  PuzzleCompleteCommand|Command  $command
     */
    public function handle($command): void
    {
        $this->puzzleService->completed($command->getUser(), $command->getPuzzle());
    }
}