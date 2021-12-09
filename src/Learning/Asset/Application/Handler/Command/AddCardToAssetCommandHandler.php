<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learning\Asset\Domain\Exception\CardAlreadyAddedException;
use Scandinaver\Learning\Asset\Domain\Exception\CardNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;
use Scandinaver\Learning\Asset\UI\Command\AddCardToAssetCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class AddCardToAssetCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class AddCardToAssetCommandHandler extends AbstractHandler
{

    public function __construct(protected AssetService $service)
    {
        parent::__construct();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws BindingResolutionException
     * @throws AssetNotFoundException
     * @throws CardAlreadyAddedException
     * @throws CardNotFoundException
     */
    public function handle(CommandInterface|AddCardToAssetCommand $command): void
    {
        $this->service->addCard(
            $command->getUser(),
            $command->getAsset(),
            $command->getCard()
        );

        $this->resource = new NullResource();
    }
}