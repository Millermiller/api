<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use App\Events\FavouriteCreated;
use Scandinaver\Learn\Domain\Contract\Command\CreateFavouriteHandlerInterface;
use Scandinaver\Learn\Domain\Services\{AssetService, FavouriteService};
use Scandinaver\Learn\UI\Command\CreateFavouriteCommand;

/**
 * Class CreateFavouriteHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CreateFavouriteHandler implements CreateFavouriteHandlerInterface
{
    protected FavouriteService $favouriteService;

    protected AssetService $assetService;

    public function __construct(AssetService $assetService, FavouriteService $favouriteService)
    {
        $this->favouriteService = $favouriteService;

        $this->assetService = $assetService;
    }

    /**
     * @param  CreateFavouriteCommand  $command
     */
    public function handle($command): void
    {
        $this->favouriteService->create($command->getLanguage(), $command->getUser(), $command->getCard());
        // event(new FavouriteCreated($command->getUser(), $command->getCard()));
    }
}