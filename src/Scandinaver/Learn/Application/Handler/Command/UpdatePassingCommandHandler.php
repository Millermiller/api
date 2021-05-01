<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exceptions\PassingNotFoundException;
use Scandinaver\Learn\Domain\Services\TestService;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Learn\UI\Command\UpdatePassingCommand;

/**
 * Class UpdatePassingHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
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
     * @param  UpdatePassingCommand|CommandInterface  $command
     *
     * @throws PassingNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->updatePassing($command->getId(), $command->getData());

        $this->resource = new NullResource();
    }
} 