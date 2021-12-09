<?php


namespace Scandinaver\Learning\Puzzle\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Puzzle\Domain\Service\PuzzleService;
use Scandinaver\Learning\Puzzle\UI\Query\UserPuzzlesQuery;
use Scandinaver\Learning\Puzzle\UI\Resource\PuzzleTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class UserPuzzlesQueryHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler
 */
class UserPuzzlesQueryHandler extends AbstractHandler
{

    public function __construct(private PuzzleService $puzzleService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|UserPuzzlesQuery  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface|UserPuzzlesQuery $query): void
    {
        $puzzles = $this->puzzleService->getForUser($query->getLanguage(), $query->getUser());

        $this->resource = new Collection($puzzles, new PuzzleTransformer());
    }
}