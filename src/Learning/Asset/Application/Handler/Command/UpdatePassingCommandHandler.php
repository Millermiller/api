<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\PassingNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\TestService;
use Scandinaver\Learning\Asset\UI\Command\UpdatePassingCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdatePassingCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class UpdatePassingCommandHandler extends AbstractHandler
{

    public function __construct(private TestService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|UpdatePassingCommand  $command
     *
     * @throws PassingNotFoundException
     */
    public function handle(CommandInterface|UpdatePassingCommand $command): void
    {
        $this->service->updatePassing($command->getId(), $command->getData());

        $this->resource = new NullResource();
    }
} 