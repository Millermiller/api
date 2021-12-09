<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\UI\Command\DeleteLogCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeleteLogCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteLogCommandHandler extends AbstractHandler
{
    //TODO: refactor
    public function __construct(private LogRepositoryInterface $logRepository)
    {
        parent::__construct();
    }

    public function handle(CommandInterface|DeleteLogCommand $command): void
    {
        $log = $this->logRepository->find($command->getId());
        $this->logRepository->delete($log);

        $this->resource = new NullResource();
    }
} 