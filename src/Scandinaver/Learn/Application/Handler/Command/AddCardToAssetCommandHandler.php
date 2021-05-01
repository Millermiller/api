<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\CardAlreadyAddedException;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Command\AddCardToAssetCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class AddCardToAssetCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class AddCardToAssetCommandHandler extends AbstractHandler
{
    protected AssetService $service;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->service = $assetService;
    }

    /**
     * @param  AddCardToAssetCommand|CommandInterface  $command
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws BindingResolutionException
     * @throws AssetNotFoundException
     * @throws CardAlreadyAddedException
     * @throws CardNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->addCard(
            $command->getUser(),
            $command->getAsset(),
            $command->getCard()
        );

        $this->resource = new NullResource();
    }
}