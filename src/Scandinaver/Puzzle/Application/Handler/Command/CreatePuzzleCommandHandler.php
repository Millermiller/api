<?php


namespace Scandinaver\Puzzle\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Puzzle\Domain\Service\PuzzleService;
use Scandinaver\Puzzle\UI\Command\CreatePuzzleCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param  CreatePuzzleCommand|BaseCommandInterface  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->puzzleService->create($command->buildDTO());

        $this->resource = new NullResource();
    }
} 