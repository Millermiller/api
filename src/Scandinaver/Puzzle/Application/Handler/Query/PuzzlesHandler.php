<?php


namespace Scandinaver\Puzzle\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Puzzle\Domain\Contract\Query\PuzzlesHandlerInterface;
use Scandinaver\Puzzle\Domain\Services\PuzzleService;
use Scandinaver\Puzzle\UI\Query\PuzzlesQuery;
use Scandinaver\Puzzle\UI\Resources\PuzzleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PuzzlesHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Query
 */
class PuzzlesHandler extends AbstractHandler implements PuzzlesHandlerInterface
{
    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        parent::__construct();

        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  PuzzlesQuery|Query  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle($query): void
    {
        $puzzles = $this->puzzleService->allByLanguage($query->getLanguage());

        $this->resource = new Collection($puzzles, new PuzzleTransformer());
    }
} 