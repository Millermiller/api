<?php


namespace Scandinaver\Learn\Application\Handlers;

use App\Events\AssetUpdated;
use Scandinaver\Learn\Application\Commands\UpdateAssetCommand;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};
use Scandinaver\Learn\Domain\Asset;

/**
 * Class CreateAssetHandler
 *
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
     *
     * @param AssetService $assetService
     * @param CardService  $cardService
     */
    public function __construct(AssetService $assetService, CardService $cardService)
    {
        $this->assetService = $assetService;

        $this->cardService = $cardService;
    }

    /**
     * @param UpdateAssetCommand $command
     *
     * @return Asset
     */
    public function handle($command): Asset
    {
        $asset = $this->assetService->updateAsset($command->getAsset(), $command->getData());

        event(new AssetUpdated($command->getUser(), $asset));

        return $asset;
    }
}