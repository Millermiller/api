<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\CreateFavouriteHandlerInterface;
use Scandinaver\Learn\Domain\Services\{AssetService, FavouriteService};
use Scandinaver\Learn\Domain\Exceptions\CardAlreadyAddedException;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\UI\Command\CreateFavouriteCommand;
use Scandinaver\Shared\Contract\Command;

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
     * @param  CreateFavouriteCommand|Command  $command
     *
     * @throws CardAlreadyAddedException
     * @throws CardNotFoundException
     */
    public function handle($command): void
    {
        $this->favouriteService->create($command->getUser(), $command->getCard());
    }
}