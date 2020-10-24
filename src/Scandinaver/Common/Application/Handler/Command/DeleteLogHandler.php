<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\UI\Command\DeleteLogCommand;
use Scandinaver\Common\Domain\Contract\Command\DeleteLogHandlerInterface;

/**
 * Class DeleteLogHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteLogHandler implements DeleteLogHandlerInterface
{

    private LogRepositoryInterface $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    /**
     * @param  DeleteLogCommand  $command
     */
    public function handle($command): void
    {
        $log = $this->logRepository->find($command->getLogId());
        $this->logRepository->delete($log);
    }
} 