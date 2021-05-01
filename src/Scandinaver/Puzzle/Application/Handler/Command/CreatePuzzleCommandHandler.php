<?php


namespace Scandinaver\Puzzle\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Puzzle\Domain\Services\PuzzleService;
use Scandinaver\Puzzle\UI\Command\CreatePuzzleCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreatePuzzleCommandHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Command
 */
class CreatePuzzleCommandHandler extends AbstractHandler
{
    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        parent::__construct();

        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  CreatePuzzleCommand|CommandInterface  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->puzzleService->create($command->getLanguage(), $command->getData());

        $this->resource = new NullResource();
    }
} 