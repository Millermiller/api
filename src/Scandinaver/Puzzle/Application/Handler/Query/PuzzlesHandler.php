<?php


namespace Scandinaver\Puzzle\Application\Handler\Query;

use Scandinaver\Puzzle\Domain\PuzzleService;
use Scandinaver\Puzzle\UI\Query\PuzzlesQuery;
use Scandinaver\Puzzle\Domain\Contract\Query\PuzzlesHandlerInterface;

/**
 * Class PuzzlesHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Query
 */
class PuzzlesHandler implements PuzzlesHandlerInterface
{

    private PuzzleService $puzzleService;

    public function __construct(PuzzleService $puzzleService)
    {
        $this->puzzleService = $puzzleService;
    }

    /**
     * @param  PuzzlesQuery  $query
     *
     * @return array
     */
    public function handle($query)
    {
        return $this->puzzleService->allByLanguage($query->getLanguage());
    }
} 