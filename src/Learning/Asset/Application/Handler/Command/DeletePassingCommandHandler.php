<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\PassingNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\TestService;
use Scandinaver\Learning\Asset\UI\Command\DeletePassingCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeletePassingCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class DeletePassingCommandHandler extends AbstractHandler
{

    public function __construct(private TestService $service)
    {
        parent::__construct();
    }

    /**
     * @param  DeletePassingCommand  $command
     *
     * @throws PassingNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->deletePassing($command->getId());

        $this->resource = new NullResource();
    }
} 