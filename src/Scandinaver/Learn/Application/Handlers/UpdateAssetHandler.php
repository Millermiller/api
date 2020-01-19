<?php


namespace Scandinaver\Learn\Application\Handlers;

use App\Events\AssetUpdated;
use Scandinaver\Learn\Application\Commands\UpdateAssetCommand;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};

/**
 * Class CreateAssetHandler
 * @package Scandinaver\Learn\Application\Handlers
 */
class UpdateAssetHandler implements UpdateAssetHandlerInteface
{
    /**
     * @var CardService
     */
    protected $cardService;

    /**
     * @var AssetService
     */
    protected $assetService;

    /**
     * AssetController constructor.
     * @param AssetService $assetService
     * @param CardService $cardService
     */
    public function __construct(AssetService $assetService, CardService $cardService)
    {
        $this->assetService = $assetService;

        $this->cardService = $cardService;
    }

    /**
     * @param UpdateAssetCommand $command
     */
    public function handle($command): void
    {
        $asset = $this->assetService->updateAsset($command->getAsset(), ['title' => $command->getTitle()]);

        event(new AssetUpdated($command->getUser(), $asset));
    }
}