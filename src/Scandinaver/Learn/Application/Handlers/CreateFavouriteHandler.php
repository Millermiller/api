<?php


namespace Scandinaver\Learn\Application\Handlers;

use App\Events\FavouriteCreated;
use Scandinaver\Learn\Application\Commands\CreateFavouriteCommand;
use Scandinaver\Learn\Domain\Services\{AssetService, FavouriteService};

/**
 * Class CreateFavouriteHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class CreateFavouriteHandler implements CreateFavouriteHandlerInterface
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
     * @param CreateFavouriteCommand $command
     */
    public function handle($command): void
    {
        $card = $this->favouriteService->create($command->getUser(), $command->getWord(), $command->getTranslate());

        event(new FavouriteCreated($command->getUser(), $card));
    }
}