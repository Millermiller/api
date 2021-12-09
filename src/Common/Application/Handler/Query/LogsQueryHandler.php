<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Doctrine\ORM\Query\QueryException;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\UI\Query\LogsQuery;
use Scandinaver\Common\UI\Resource\LogTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class LogsQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class LogsQueryHandler extends AbstractHandler
{

    //TODO: refactor
    public function __construct(private LogRepositoryInterface $logRepository)
    {
        parent::__construct();
    }

    /**
     * @throws QueryException
     */
    public function handle(BaseCommandInterface|LogsQuery $query): void
    {
        $data = $this->logRepository->getData($query->getParameters());

        $this->fractal->parseExcludes(['owner.roles', 'owner.permissions']);
        $this->resource = new Collection($data->items(), new LogTransformer());

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
} 