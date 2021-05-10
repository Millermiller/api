<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\UI\Query\LogQuery;
use Scandinaver\Common\UI\Resource\LogTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class LogQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class LogQueryHandler extends AbstractHandler
{
    private LogRepositoryInterface $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        parent::__construct();

        $this->logRepository = $logRepository;
    }

    /**
     * @param  LogQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $log = $this->logRepository->find($query->getLogId());

        $this->resource = new Item($log, new LogTransformer());
    }
} 