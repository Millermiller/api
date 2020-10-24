<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Contract\Command\CreateAssetHandlerInterface;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};
use Scandinaver\Learn\Domain\Model\AssetDTO;
use Scandinaver\Learn\UI\Command\CreateAssetCommand;

/**
 * Class CreateAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CreateAssetHandler implements CreateAssetHandlerInterface
{
    protected CardService $cardService;

    protected AssetService $assetService;

    public function __construct(AssetService $assetService, CardService $cardService)
    {
        $this->assetService = $assetService;

        $this->cardService = $cardService;
    }

    /**
     * @param  CreateAssetCommand  $command
     *
     * @return AssetDTO
     */
    public function handle($command): AssetDTO
    {
        $asset = $this->assetService->create($command->getLanguage(), $command->getUser(), $command->getTitle());

        return $asset;
    }
}