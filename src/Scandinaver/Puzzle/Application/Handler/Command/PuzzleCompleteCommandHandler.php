<?php


namespace Scandinaver\Puzzle\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Puzzle\Domain\Exception\PuzzleNotFoundException;
use Scandinaver\Puzzle\Domain\Service\PuzzleService;
use Scandinaver\Puzzle\UI\Command\PuzzleCompleteCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param  PuzzleCompleteCommand|BaseCommandInterface  $command
     *
     * @throws PuzzleNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->puzzleService->completed($command->getUser(), $command->getPuzzle());

        $this->resource = new NullResource();
    }
}