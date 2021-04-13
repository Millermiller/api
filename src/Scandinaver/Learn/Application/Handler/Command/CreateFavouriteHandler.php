<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Contract\Command\CreateFavouriteHandlerInterface;
use Scandinaver\Learn\Domain\Services\{AssetService, FavouriteService};
use Scandinaver\Learn\Domain\Exceptions\CardAlreadyAddedException;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\UI\Command\CreateFavouriteCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateFavouriteHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CreateFavouriteHandler extends AbstractHandler implements CreateFavouriteHandlerInterface
{
    protected FavouriteService $favouriteService;

    public function __construct(FavouriteService $favouriteService)
    {
        parent::__construct();

        $this->favouriteService = $favouriteService;
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

        $this->resource = new NullResource();
    }
}