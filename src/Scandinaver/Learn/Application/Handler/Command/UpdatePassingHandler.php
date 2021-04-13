<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exceptions\PassingNotFoundException;
use Scandinaver\Learn\Domain\Services\TestService;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\Learn\UI\Command\UpdatePassingCommand;
use Scandinaver\Learn\Domain\Contract\Command\UpdatePassingHandlerInterface;

/**
 * Class UpdatePassingHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UpdatePassingHandler extends AbstractHandler implements UpdatePassingHandlerInterface
{

    private TestService $service;

    public function __construct(TestService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdatePassingCommand|Command  $command
     *
     * @throws PassingNotFoundException
     */
    public function handle($command): void
    {
        $this->service->updatePassing($command->getId(), $command->getData());

        $this->resource = new NullResource();
    }
} 