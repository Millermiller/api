<?php


namespace Scandinaver\Learn\Application\Handlers;

use App\Events\FavouriteDeleted;
use Doctrine\ORM\{OptimisticLockException, ORMException};
use Scandinaver\Learn\Application\Commands\DeleteFavouriteCommand;
use Scandinaver\Learn\Domain\Services\{AssetService, FavouriteService};

/**
 * Class CreateFavouriteHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class DeleteFavouriteHandler implements DeleteFavouriteHandlerInterface
{
    /**
     * @var FavouriteService
     */
    protected $favouriteService;

    /**
     * @var AssetService
     */
    protected $assetService;

    /**
     * FavouriteController constructor.
     *
     * @param AssetService     $assetService
     * @param FavouriteService $favouriteService
     */
    public function __construct(AssetService $assetService, FavouriteService $favouriteService)
    {
        $this->favouriteService = $favouriteService;

        $this->assetService = $assetService;
    }

    /**
     * @param DeleteFavouriteCommand $command
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handle($command): void
    {
        $this->favouriteService->delete($command->getLanguage(), $command->getUser(), $command->getId());

        event(new FavouriteDeleted($command->getUser()));
    }
}