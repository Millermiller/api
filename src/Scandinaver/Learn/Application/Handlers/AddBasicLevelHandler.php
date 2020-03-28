<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Commands\AddBasicLevelCommand;
use Scandinaver\Learn\Domain\Services\AssetService;

/**
 * Class AddBasicLevelHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class AddBasicLevelHandler implements AddBasicLevelHandlerInterface
{
    /**
     * @var AssetService
     */
    protected $assetService;

    /**
     * AddBasicLevelHandler constructor.
     *
     * @param AssetService $assetService
     */
    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param AddBasicLevelCommand $command
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->assetService->addBasic($command->getAssetId());
    }
} 