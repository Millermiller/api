<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\UpdateAssetHandlerInteface;
use Scandinaver\Learn\Domain\Model\AssetDTO;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};
use Scandinaver\Learn\UI\Command\UpdateAssetCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UpdateAssetHandler implements UpdateAssetHandlerInteface
{
    protected CardService $cardService;

    protected AssetService $assetService;

    /**
     * AssetController constructor.
     *
     * @param  AssetService  $assetService
     * @param  CardService   $cardService
     */
    public function __construct(AssetService $assetService, CardService $cardService)
    {
        $this->assetService = $assetService;

        $this->cardService = $cardService;
    }

    /**
     * @param  UpdateAssetCommand|Command  $command
     *
     * @return AssetDTO
     */
    public function handle($command): AssetDTO
    {
        $asset = $this->assetService->updateAsset($command->getAsset(), $command->getData());

        // event(new AssetUpdated($command->getUser(), $asset));

        return $asset;
    }
}