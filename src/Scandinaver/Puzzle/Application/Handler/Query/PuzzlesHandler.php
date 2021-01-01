<?php


namespace Scandinaver\Puzzle\Application\Handler\Query;

use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Puzzle\Domain\PuzzleService;
use Scandinaver\Puzzle\UI\Query\PuzzlesQuery;
use Scandinaver\Puzzle\Domain\Contract\Query\PuzzlesHandlerInterface;
use Scandinaver\Shared\Contract\Query;

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
     * @param  PuzzlesQuery|Query  $query
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function handle($query): array
    {
        return $this->puzzleService->allByLanguage($query->getLanguage());
    }
} 