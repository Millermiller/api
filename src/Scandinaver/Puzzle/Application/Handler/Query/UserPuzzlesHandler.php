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
    /**
     * @var PuzzleService
     */
    private PuzzleService $puzzleService;

    /**
     * PuzzleCompletedHandler constructor.
     *
     * @param  PuzzleService  $puzzleService
     */
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
        return $this->puzzleService->getForUser($query->getUser());
    }
}