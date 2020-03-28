<?php


namespace Scandinaver\Learn\Application\Handlers;

use App\Events\AssetCreated;
use Doctrine\ORM\{OptimisticLockException, ORMException};
use Scandinaver\Learn\Application\Commands\CreateAssetCommand;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};

/**
 * Class CreateAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class CreateAssetHandler implements CreateAssetHandlerInteface
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
     * @param CreateAssetCommand $command
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handle($command): void
    {
        $asset = $this->assetService->create($command->getLanguage(), $command->getUser(), $command->getTitle());

        event(new AssetCreated($command->getUser(), $asset));

    }
}