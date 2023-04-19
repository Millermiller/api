<?php


namespace Scandinaver\Learning\Puzzle\Application\Handler\Query;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
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
     * @param  BaseCommandInterface|PuzzlesQuery  $query
     */
    public function handle(BaseCommandInterface|PuzzlesQuery $query): void
    {
        $data = $this->puzzleService->paginate($query->getParameters());

        $this->resource = new Collection($data->items(), new PuzzleTransformer());

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
} 