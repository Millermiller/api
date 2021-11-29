<?php


namespace Scandinaver\Learning\Puzzle\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Puzzle\Domain\Service\PuzzleService;
use Scandinaver\Learning\Puzzle\UI\Query\PuzzlesQuery;
use Scandinaver\Learning\Puzzle\UI\Resource\PuzzleTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class PuzzlesQueryHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Query
 */
class PuzzlesQueryHandler extends AbstractHandler
{

    public function __construct(private PuzzleService $puzzleService)
    {
        parent::__construct();
    }

    /**
     * @param  PuzzlesQuery  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $puzzles = $this->puzzleService->allByLanguage($query->getLanguage());

        $this->resource = new Collection($puzzles, new PuzzleTransformer());
    }
} 