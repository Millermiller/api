<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\CompleteTestHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Command\CompleteTestCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class SaveTestResultHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CompleteTestHandler implements CompleteTestHandlerInterface
{
    private AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param  CompleteTestCommand|Command  $command
     *
     * @throws AssetNotFoundException
     */
    public function handle($command): void
    {
        $this->assetService->saveTestResult(
            $command->getUser(),
            $command->getAsset(),
            $command->getData()
        );
    }
}