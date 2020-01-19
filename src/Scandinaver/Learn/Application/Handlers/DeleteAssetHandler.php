<?php


namespace Scandinaver\Learn\Application\Handlers;

use App\Helpers\Auth;
use App\Events\AssetDelete;
use Scandinaver\Learn\Application\Commands\DeleteAssetCommand;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};

/**
 * Class DeleteAssetHandler
 * @package Scandinaver\Learn\Application\Handlers
 */
class DeleteAssetHandler implements DeleteAssetHandlerInterface
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
     * @param DeleteAssetCommand $command
     */
    public function handle($command): void
    {
        $this->assetService->delete($command->getAsset());

        event(new AssetDelete(Auth::user(), $command->getAsset()));
    }
}