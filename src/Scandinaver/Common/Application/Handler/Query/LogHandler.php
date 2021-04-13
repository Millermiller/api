<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Contract\Query\LogHandlerInterface;
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\UI\Query\LogQuery;
use Scandinaver\Common\UI\Resources\LogTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class LogHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class LogHandler extends AbstractHandler implements LogHandlerInterface
{
    private LogRepositoryInterface $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        parent::__construct();

        $this->logRepository = $logRepository;
    }

    /**
     * @param  LogQuery|Query  $query
     */
    public function handle($query): void
    {
        $log = $this->logRepository->find($query->getLogId());

        $this->resource = new Item($log, new LogTransformer());
    }
} 