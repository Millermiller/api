<?php


namespace Scandinaver\Puzzle\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Puzzle\Domain\Exception\PuzzleNotFoundException;
use Scandinaver\Puzzle\Domain\Service\PuzzleService;
use Scandinaver\Puzzle\UI\Command\DeletePuzzleCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeletePuzzleCommandHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Command
 */
class DeletePuzzleCommandHandler extends AbstractHandler
{
    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        parent::__construct();

        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  DeletePuzzleCommand|CommandInterface  $command
     *
     * @throws PuzzleNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->puzzleService->delete($command->getPuzzle());

        $this->resource = new NullResource();
    }
} 