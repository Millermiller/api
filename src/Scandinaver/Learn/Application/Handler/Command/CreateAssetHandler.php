<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use App\Events\AssetCreated;
use Doctrine\ORM\{OptimisticLockException, ORMException};
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Contract\Command\CreateAssetHandlerInterface;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};
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
     * @param  CreateAssetCommand  $command
     *
     * @return Asset
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handle($command): Asset
    {
        $asset = $this->assetService->create($command->getLanguage(), $command->getUser(), $command->getTitle());

        event(new AssetCreated($command->getUser(), $asset));

        return $asset;
    }
}