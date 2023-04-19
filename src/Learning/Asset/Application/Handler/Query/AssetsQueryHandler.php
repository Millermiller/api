<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;
use Scandinaver\Learning\Asset\UI\Query\AssetsQuery;
use Scandinaver\Learning\Asset\UI\Resource\AssetTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class AssetsQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetsQueryHandler extends AbstractHandler
{

    public function __construct(private readonly AssetService $assetService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|AssetsQuery  $query
     */
    public function handle(BaseCommandInterface|AssetsQuery $query): void
    {
        $data = $this->assetService->paginate($query->getParameters());

        $this->resource = new Collection($data->items(), new AssetTransformer());

        $this->fractal->parseIncludes('cards');

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
}