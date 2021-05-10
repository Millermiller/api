<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exception\CardNotFoundException;
use Scandinaver\Learn\Domain\Service\{FavouriteService};
use Scandinaver\Learn\UI\Command\DeleteFavouriteCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class DeleteFavouriteCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class DeleteFavouriteCommandHandler extends AbstractHandler
{
    protected FavouriteService $favouriteService;

    public function __construct(FavouriteService $favouriteService)
    {
        parent::__construct();

        $this->favouriteService = $favouriteService;
    }

    /**
     * @param  DeleteFavouriteCommand|BaseCommandInterface  $command
     *
     * @throws CardNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->favouriteService->delete($command->getUser(), $command->getCard());

        $this->resource = new NullResource();
    }
}