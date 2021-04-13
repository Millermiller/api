<?php


namespace Scandinaver\Puzzle\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Puzzle\Domain\Contract\Command\PuzzleCompleteHandlerInterface;
use Scandinaver\Puzzle\Domain\Exception\PuzzleNotFoundException;
use Scandinaver\Puzzle\Domain\Services\PuzzleService;
use Scandinaver\Puzzle\UI\Command\PuzzleCompleteCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class PuzzleCompletedHandler
 *
 * @package Scandinaver\Puzzle\Application
 */
class PuzzleCompleteHandler extends AbstractHandler implements PuzzleCompleteHandlerInterface
{
    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        parent::__construct();

        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  PuzzleCompleteCommand|Command  $command
     *
     * @throws PuzzleNotFoundException
     */
    public function handle($command): void
    {
        $this->puzzleService->completed($command->getUser(), $command->getPuzzle());

        $this->resource = new NullResource();
    }
}