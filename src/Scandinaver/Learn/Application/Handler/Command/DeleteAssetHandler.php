<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use App\Events\AssetDelete;
use App\Helpers\Auth;
use Scandinaver\Learn\Domain\Contract\Command\DeleteAssetHandlerInterface;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};
use Scandinaver\Learn\UI\Command\DeleteAssetCommand;

/**
 * Class DeleteAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class DeleteAssetHandler implements DeleteAssetHandlerInterface
{
    protected CardService $cardService;

    protected AssetService $assetService;

    public function __construct(AssetService $assetService, CardService $cardService)
    {
        $this->assetService = $assetService;

        $this->cardService = $cardService;
    }

    /**
     * @param  DeleteAssetCommand  $command
     */
    public function handle($command): void
    {
        $this->assetService->delete($command->getAsset());

        event(new AssetDelete(Auth::user(), $command->getAsset()));
    }
}