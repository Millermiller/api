<?php


namespace Scandinaver\Learning\Puzzle\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Puzzle\Domain\Exception\PuzzleNotFoundException;
use Scandinaver\Learning\Puzzle\Domain\Service\PuzzleService;
use Scandinaver\Learning\Puzzle\UI\Command\DeletePuzzleCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeletePuzzleCommandHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Command
 */
class DeletePuzzleCommandHandler extends AbstractHandler
{

    public function __construct(private PuzzleService $puzzleService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|DeletePuzzleCommand  $command
     *
     * @throws PuzzleNotFoundException
     */
    public function handle(CommandInterface|DeletePuzzleCommand $command): void
    {
        $this->puzzleService->delete($command->getPuzzle());

        $this->resource = new NullResource();
    }
} 