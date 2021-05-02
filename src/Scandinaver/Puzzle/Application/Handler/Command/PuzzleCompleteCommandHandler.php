<?php


namespace Scandinaver\Puzzle\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Puzzle\Domain\Exception\PuzzleNotFoundException;
use Scandinaver\Puzzle\Domain\Service\PuzzleService;
use Scandinaver\Puzzle\UI\Command\PuzzleCompleteCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PuzzleCompleteCommandHandler
 *
 * @package Scandinaver\Puzzle\Application
 */
class PuzzleCompleteCommandHandler extends AbstractHandler
{
    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        parent::__construct();

        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  PuzzleCompleteCommand|CommandInterface  $command
     *
     * @throws PuzzleNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->puzzleService->completed($command->getUser(), $command->getPuzzle());

        $this->resource = new NullResource();
    }
}