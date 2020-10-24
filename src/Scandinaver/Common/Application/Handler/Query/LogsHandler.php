<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\Domain\Model\Log;
use Scandinaver\Common\Domain\Contract\Query\LogsHandlerInterface;

/**
 * Class LogsHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class LogsHandler implements LogsHandlerInterface
{
    private LogRepositoryInterface $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    public function handle($query)
    {
        /** @var Log[] $logs */
        $logs = $this->logRepository->all();

        $response = [];

        foreach ($logs as $log) {
            $response[] = [
                'id' => $log->getId(),
                'message' => $log->interpolate(),
                'owner' => $log->getOwner(),
                'level' => $log->getLevelName(),
                'extra' => $log->getExtra(),
                'created_at' => $log->getCreatedAt()->format('Y-m-d H:i:s'),
            ];
        }

        return $response;
    }
} 