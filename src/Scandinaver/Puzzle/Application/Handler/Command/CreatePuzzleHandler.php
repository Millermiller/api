<?php


namespace Scandinaver\Puzzle\Application\Handler\Command;

use Scandinaver\Puzzle\Domain\PuzzleService;
use Scandinaver\Puzzle\UI\Command\CreatePuzzleCommand;
use Scandinaver\Puzzle\Domain\Contract\Command\CreatePuzzleHandlerInterface;

/**
 * Class CreatePuzzleHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Command
 */
class CreatePuzzleHandler implements CreatePuzzleHandlerInterface
{

    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  CreatePuzzleCommand  $command
     */
    public function handle($command): void
    {
        $this->puzzleService->create($command->getLanguage(), $command->getData());
    }
} 