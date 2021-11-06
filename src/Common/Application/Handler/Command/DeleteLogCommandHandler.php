<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\UI\Command\DeleteLogCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class DeleteLogCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteLogCommandHandler extends AbstractHandler
{
    private LogRepositoryInterface $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        parent::__construct();

        $this->logRepository = $logRepository;
    }

    /**
     * @param  DeleteLogCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        $log = $this->logRepository->find($command->getLogId());
        $this->logRepository->delete($log);

        $this->resource = new NullResource();
    }
} 