<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\CompleteTestHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Services\TestService;
use Scandinaver\Learn\UI\Command\CompleteTestCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class SaveTestResultHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CompleteTestHandler implements CompleteTestHandlerInterface
{
    private TestService $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    /**
     * @param  CompleteTestCommand|Command  $command
     *
     * @throws AssetNotFoundException
     */
    public function handle($command): void
    {
        $this->testService->savePassing(
            $command->getUser(),
            $command->getAsset(),
            $command->getData()
        );
    }
}