<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use App\Events\FavouriteDeleted;
use Doctrine\ORM\{OptimisticLockException, ORMException};
use Scandinaver\Learn\Domain\Contract\Command\DeleteFavouriteHandlerInterface;
use Scandinaver\Learn\Domain\Services\{AssetService, FavouriteService};
use Scandinaver\Learn\UI\Command\DeleteFavouriteCommand;

/**
 * Class CreateFavouriteHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class DeleteFavouriteHandler implements DeleteFavouriteHandlerInterface
{
    protected FavouriteService $favouriteService;

    protected AssetService $assetService;

    public function __construct(AssetService $assetService, FavouriteService $favouriteService)
    {
        $this->favouriteService = $favouriteService;

        $this->assetService = $assetService;
    }

    /**
     * @param  DeleteFavouriteCommand  $command
     *
     */
    public function handle($command): void
    {
        $this->favouriteService->delete($command->getLanguage(), $command->getUser(), $command->getCard());

        event(new FavouriteDeleted($command->getUser()));
    }
}