<?php


namespace Scandinaver\Statistic\Application\Handler\Query;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;
use Scandinaver\Statistic\Domain\Service\StatisticService;
use Scandinaver\Statistic\UI\Query\GetStatisticQuery;
use Scandinaver\Statistic\UI\Resource\StatisticTransformer;

/**
 * Class GetStatisticQueryQueryHandler
 *
 * @package Scandinaver\Statistic\Application\Handler\Query
 */
class GetStatisticQueryHandler extends AbstractHandler
{
    public function __construct(private readonly StatisticService $statisticService)
    {
        parent::__construct();
    }

    /**
     * @param BaseCommandInterface|GetStatisticQuery  $query
     */
    public function handle(BaseCommandInterface|GetStatisticQuery $query): void
    {
        $data = $this->statisticService->paginate($query->getParameters());

        $this->resource = new Collection($data->items(), new StatisticTransformer(), 'statistic');

        // $this->fractal->parseIncludes('statistic');

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
} 