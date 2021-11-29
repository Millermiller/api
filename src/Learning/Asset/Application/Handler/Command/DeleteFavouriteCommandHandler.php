<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\CardNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\{FavouriteService};
use Scandinaver\Learning\Asset\UI\Command\DeleteFavouriteCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeleteFavouriteCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class DeleteFavouriteCommandHandler extends AbstractHandler
{

    public function __construct(protected FavouriteService $favouriteService)
    {
        parent::__construct();
    }

    /**
     * @param  DeleteFavouriteCommand  $command
     *
     * @throws CardNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->favouriteService->delete($command->getUser(), $command->getCard());

        $this->resource = new NullResource();
    }
}