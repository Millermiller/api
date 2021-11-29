<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\UI\Query\LogQuery;
use Scandinaver\Common\UI\Resource\LogTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class LogQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class LogQueryHandler extends AbstractHandler
{

    //TODO: refactor
    public function __construct(private LogRepositoryInterface $logRepository)
    {
        parent::__construct();

    }

    /**
     * @param  LogQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $log = $this->logRepository->find($query->getLogId());

        $this->resource = new Item($log, new LogTransformer());
    }
} 