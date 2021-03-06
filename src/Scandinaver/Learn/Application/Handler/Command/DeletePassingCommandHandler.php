<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exception\PassingNotFoundException;
use Scandinaver\Learn\Domain\Service\TestService;
use Scandinaver\Learn\UI\Command\DeletePassingCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class DeletePassingCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class DeletePassingCommandHandler extends AbstractHandler
{
    private TestService $service;

    public function __construct(TestService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  DeletePassingCommand|BaseCommandInterface  $command
     *
     * @throws PassingNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->service->deletePassing($command->getId());

        $this->resource = new NullResource();
    }
} 