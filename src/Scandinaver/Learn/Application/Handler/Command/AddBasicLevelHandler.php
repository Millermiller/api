<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\AddBasicLevelHandlerInterface;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Command\AddBasicLevelCommand;

/**
 * Class AddBasicLevelHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class AddBasicLevelHandler implements AddBasicLevelHandlerInterface
{
    /**
     * @var AssetService
     */
    protected AssetService $assetService;

    /**
     * AddBasicLevelHandler constructor.
     *
     * @param  AssetService  $assetService
     */
    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param  AddBasicLevelCommand  $command
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->assetService->addBasic($command->getAssetId());
    }
} 