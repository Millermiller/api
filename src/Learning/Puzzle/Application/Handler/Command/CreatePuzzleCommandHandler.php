<?php


namespace Scandinaver\Learning\Puzzle\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Puzzle\Domain\Service\PuzzleService;
use Scandinaver\Learning\Puzzle\UI\Command\CreatePuzzleCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreatePuzzleCommandHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Command
 */
class CreatePuzzleCommandHandler extends AbstractHandler
{

    public function __construct(private PuzzleService $puzzleService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|CreatePuzzleCommand  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface|CreatePuzzleCommand $command): void
    {
        $this->puzzleService->create($command->buildDTO());

        $this->resource = new NullResource();
    }
} 