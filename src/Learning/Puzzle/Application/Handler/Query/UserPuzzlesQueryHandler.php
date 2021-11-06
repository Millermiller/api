<?php


namespace Scandinaver\Learning\Puzzle\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Puzzle\Domain\Service\PuzzleService;
use Scandinaver\Learning\Puzzle\UI\Query\UserPuzzlesQuery;
use Scandinaver\Learning\Puzzle\UI\Resource\PuzzleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class UserPuzzlesQueryHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler
 */
class UserPuzzlesQueryHandler extends AbstractHandler
{
    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        parent::__construct();

        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  UserPuzzlesQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $puzzles = $this->puzzleService->getForUser($query->getLanguage(), $query->getUser());

        $this->resource = new Collection($puzzles, new PuzzleTransformer());
    }
}