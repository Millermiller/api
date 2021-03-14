<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Exceptions\PassingNotFoundException;
use Scandinaver\Learn\Domain\Services\TestService;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\Learn\UI\Command\DeletePassingCommand;
use Scandinaver\Learn\Domain\Contract\Command\DeletePassingHandlerInterface;

/**
 * Class DeletePassingHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class DeletePassingHandler implements DeletePassingHandlerInterface
{

    private TestService $service;

    public function __construct(TestService $service)
    {
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
    }
} 