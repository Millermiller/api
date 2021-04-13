<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exceptions\PassingNotFoundException;
use Scandinaver\Learn\Domain\Services\TestService;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\Learn\UI\Command\DeletePassingCommand;
use Scandinaver\Learn\Domain\Contract\Command\DeletePassingHandlerInterface;

/**
 * Class DeletePassingHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class DeletePassingHandler extends AbstractHandler implements DeletePassingHandlerInterface
{

    private TestService $service;

    public function __construct(TestService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  DeletePassingCommand|Command  $command
     *
     * @throws PassingNotFoundException
     */
    public function handle($command): void
    {
        $this->service->deletePassing($command->getId());

        $this->resource = new NullResource();
    }
} 