<?php


namespace Scandinaver\Puzzle\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Puzzle\Domain\Contract\Query\UserPuzzlesHandlerInterface;
use Scandinaver\Puzzle\Domain\Services\PuzzleService;
use Scandinaver\Puzzle\UI\Query\UserPuzzlesQuery;
use Scandinaver\Puzzle\UI\Resources\PuzzleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class UserPuzzlesHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler
 */
class UserPuzzlesHandler extends AbstractHandler implements UserPuzzlesHandlerInterface
{
    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        parent::__construct();

        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  UserPuzzlesQuery|Query  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle($query): void
    {
        $puzzles = $this->puzzleService->getForUser($query->getLanguage(), $query->getUser());

        $this->resource = new Collection($puzzles, new PuzzleTransformer());
    }
}