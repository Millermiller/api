<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Query\GetCardsQuery;
use Scandinaver\Learning\Asset\UI\Resource\CardTransformer;

/**
 * Class GetCardsQueryHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Query
 */
class GetCardsQueryHandler extends AbstractHandler
{
    public function __construct(private CardService $service)
    {
        parent::__construct();
    }

    public function handle(BaseCommandInterface|GetCardsQuery $query): void
    {
        $data = $this->service->paginate($query->getParameters());

        $this->resource = new Collection($data->items(), new CardTransformer());

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
} 