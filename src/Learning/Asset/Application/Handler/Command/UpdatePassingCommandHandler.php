<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\PassingNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\TestService;
use Scandinaver\Learning\Asset\UI\Command\UpdatePassingCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class UpdatePassingCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class UpdatePassingCommandHandler extends AbstractHandler
{

    private TestService $service;

    public function __construct(TestService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdatePassingCommand|BaseCommandInterface  $command
     *
     * @throws PassingNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->service->updatePassing($command->getId(), $command->getData());

        $this->resource = new NullResource();
    }
} 