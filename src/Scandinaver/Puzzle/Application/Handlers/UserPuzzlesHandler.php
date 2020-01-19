<?php


namespace Scandinaver\Puzzle\Application\Handlers;

use Scandinaver\Puzzle\Application\Query\UserPuzzlesQuery;
use Scandinaver\Puzzle\Domain\PuzzleService;

/**
 * Class UserPuzzlesHandler
 * @package Scandinaver\Puzzle\Application\Handlers
 */
class UserPuzzlesHandler implements UserPuzzlesHandlerInterface
{
    /**
     * @var PuzzleService
     */
    private $puzzleService;

    /**
     * PuzzleCompletedHandler constructor.
     * @param PuzzleService $puzzleService
     */
    public function __construct(PuzzleService $puzzleService)
    {
        $this->puzzleService = $puzzleService;
    }

    /**
     * @param UserPuzzlesQuery $query
     * @return array
     */
    public function handle($query): array
    {
        return $this->puzzleService->getForUser($query->getUser());
    }
}