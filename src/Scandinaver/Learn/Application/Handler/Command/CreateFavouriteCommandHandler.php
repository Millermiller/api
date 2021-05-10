<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exception\CardAlreadyAddedException;
use Scandinaver\Learn\Domain\Exception\CardNotFoundException;
use Scandinaver\Learn\Domain\Service\{FavouriteService};
use Scandinaver\Learn\UI\Command\CreateFavouriteCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CreateFavouriteCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CreateFavouriteCommandHandler extends AbstractHandler
{
    protected FavouriteService $favouriteService;

    public function __construct(FavouriteService $favouriteService)
    {
        parent::__construct();

        $this->favouriteService = $favouriteService;
    }

    /**
     * @param  CreateFavouriteCommand|BaseCommandInterface  $command
     *
     * @throws CardAlreadyAddedException
     * @throws CardNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->favouriteService->create($command->getUser(), $command->getCard());

        $this->resource = new NullResource();
    }
}