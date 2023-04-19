<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use Doctrine\ORM\Query\QueryException;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Service\TestService;
use Scandinaver\Learning\Asset\UI\Query\GetAllPassingsQuery;
use Scandinaver\Learning\Asset\UI\Resource\PassingTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class GetAllPassingsQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetAllPassingsQueryHandler extends AbstractHandler
{

    public function __construct(private TestService $service)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|GetAllPassingsQuery  $query
     *
     * @throws QueryException
     */
    public function handle(BaseCommandInterface|GetAllPassingsQuery $query): void
    {
        $data = $this->service->paginate($query->getParameters());

        $this->resource = new Collection($data->items(), new PassingTransformer());

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
} 