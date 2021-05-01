<?php


namespace Scandinaver\Puzzle\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Puzzle\Domain\Services\PuzzleService;
use Scandinaver\Puzzle\UI\Query\PuzzlesQuery;
use Scandinaver\Puzzle\UI\Resources\PuzzleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PuzzlesQueryHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Query
 */
class PuzzlesQueryHandler extends AbstractHandler
{
    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        parent::__construct();

        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  PuzzlesQuery|CommandInterface  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $query): void
    {
        $puzzles = $this->puzzleService->allByLanguage($query->getLanguage());

        $this->resource = new Collection($puzzles, new PuzzleTransformer());
    }
} 