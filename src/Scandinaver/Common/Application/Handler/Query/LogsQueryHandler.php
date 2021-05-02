<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\Domain\Model\Log;
use Scandinaver\Common\UI\Resource\LogTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class LogsQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class LogsQueryHandler extends AbstractHandler
{
    private LogRepositoryInterface $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        parent::__construct();

        $this->logRepository = $logRepository;
    }

    /**
     * @param  Query  $query
     */
    public function handle(CommandInterface $query): void
    {
        /** @var Log[] $logs */
        $logs = $this->logRepository->findAll();

        $this->resource = new Collection($logs, new LogTransformer());
    }
} 