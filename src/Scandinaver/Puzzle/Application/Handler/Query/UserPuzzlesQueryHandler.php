<?php


namespace Scandinaver\Puzzle\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Puzzle\Domain\Services\PuzzleService;
use Scandinaver\Puzzle\UI\Query\UserPuzzlesQuery;
use Scandinaver\Puzzle\UI\Resources\PuzzleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

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
     * @param  UserPuzzlesQuery|CommandInterface  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $query): void
    {
        $puzzles = $this->puzzleService->getForUser($query->getLanguage(), $query->getUser());

        $this->resource = new Collection($puzzles, new PuzzleTransformer());
    }
}