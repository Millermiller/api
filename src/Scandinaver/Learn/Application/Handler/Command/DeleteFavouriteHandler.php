<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Contract\Command\DeleteFavouriteHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\Domain\Services\{FavouriteService};
use Scandinaver\Learn\UI\Command\DeleteFavouriteCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateFavouriteHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class DeleteFavouriteHandler extends AbstractHandler implements DeleteFavouriteHandlerInterface
{
    protected FavouriteService $favouriteService;

    public function __construct(FavouriteService $favouriteService)
    {
        parent::__construct();

        $this->favouriteService = $favouriteService;
    }

    /**
     * @param  DeleteFavouriteCommand|Command  $command
     *
     * @throws CardNotFoundException
     */
    public function handle($command): void
    {
        $this->favouriteService->delete($command->getUser(), $command->getCard());

        $this->resource = new NullResource();
    }
}