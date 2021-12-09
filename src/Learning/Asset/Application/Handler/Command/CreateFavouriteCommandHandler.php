<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\CardAlreadyAddedException;
use Scandinaver\Learning\Asset\Domain\Exception\CardNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\{FavouriteService};
use Scandinaver\Learning\Asset\UI\Command\CreateFavouriteCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateFavouriteCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class CreateFavouriteCommandHandler extends AbstractHandler
{

    public function __construct(protected FavouriteService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|CreateFavouriteCommand  $command
     *
     * @throws CardAlreadyAddedException
     * @throws CardNotFoundException
     */
    public function handle(CommandInterface|CreateFavouriteCommand $command): void
    {
        $this->service->create($command->getUser(), $command->getCard());

        $this->resource = new NullResource();
    }
}