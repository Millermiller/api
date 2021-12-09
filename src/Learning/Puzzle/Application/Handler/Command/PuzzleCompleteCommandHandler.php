<?php


namespace Scandinaver\Learning\Puzzle\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Puzzle\Domain\Exception\PuzzleNotFoundException;
use Scandinaver\Learning\Puzzle\Domain\Service\PuzzleService;
use Scandinaver\Learning\Puzzle\UI\Command\PuzzleCompleteCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class PuzzleCompleteCommandHandler
 *
 * @package Scandinaver\Puzzle\Application
 */
class PuzzleCompleteCommandHandler extends AbstractHandler
{

    public function __construct(private PuzzleService $puzzleService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|PuzzleCompleteCommand  $command
     *
     * @throws PuzzleNotFoundException
     */
    public function handle(CommandInterface|PuzzleCompleteCommand $command): void
    {
        $this->puzzleService->completed($command->getUser(), $command->getPuzzle());

        $this->resource = new NullResource();
    }
}