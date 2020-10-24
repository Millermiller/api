<?php


namespace Scandinaver\Puzzle\Application\Handler\Query;

use Scandinaver\Puzzle\Domain\Contract\Query\UserPuzzlesHandlerInterface;
use Scandinaver\Puzzle\Domain\PuzzleService;
use Scandinaver\Puzzle\UI\Query\UserPuzzlesQuery;

/**
 * Class UserPuzzlesHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler
 */
class UserPuzzlesHandler implements UserPuzzlesHandlerInterface
{
    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  UserPuzzlesQuery  $query
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->puzzleService->getForUser($query->getLanguage(), $query->getUser());
    }
}