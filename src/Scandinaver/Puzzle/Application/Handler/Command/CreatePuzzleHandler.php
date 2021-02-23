<?php


namespace Scandinaver\Puzzle\Application\Handler\Command;

use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Puzzle\Domain\Contract\Command\CreatePuzzleHandlerInterface;
use Scandinaver\Puzzle\Domain\PuzzleService;
use Scandinaver\Puzzle\UI\Command\CreatePuzzleCommand;
use Scandinaver\Shared\Contract\Command;

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
     * @param  CreatePuzzleCommand|Command  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle($command): void
    {
        $this->puzzleService->create($command->getLanguage(), $command->getData());
    }
} 