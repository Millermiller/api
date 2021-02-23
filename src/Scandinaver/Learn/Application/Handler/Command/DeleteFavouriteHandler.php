<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\DeleteFavouriteHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\{AssetService, FavouriteService};
use Scandinaver\Learn\UI\Command\DeleteFavouriteCommand;
use Scandinaver\Shared\Contract\Command;

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
     * @param  DeleteFavouriteCommand|Command  $command
     *
     * @throws CardNotFoundException
     * @throws LanguageNotFoundException
     */
    public function handle($command): void
    {
        $this->favouriteService->delete($command->getLanguage(), $command->getUser(), $command->getCard());
    }
}