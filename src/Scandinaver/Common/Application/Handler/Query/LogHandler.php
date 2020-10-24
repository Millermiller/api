<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\UI\Query\LogQuery;
use Scandinaver\Common\Domain\Contract\Query\LogHandlerInterface;

/**
 * Class LogHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class LogHandler implements LogHandlerInterface
{

    private LogRepositoryInterface $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    /**
     * @param  LogQuery  $query
     *
     * @return array
     */
    public function handle($query)
    {
        $log = $this->logRepository->find($query->getLogId());

        return [
            'id' => $log->getId(),
            'message' => $log->interpolate(),
            'owner' => $log->getOwner(),
            'level' => $log->getLevelName(),
            'extra' => $log->getExtra(),
            'created_at' => $log->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }
} 