<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learn\Domain\Exception\CardAlreadyAddedException;
use Scandinaver\Learn\Domain\Exception\CardNotFoundException;
use Scandinaver\Learn\Domain\Service\AssetService;
use Scandinaver\Learn\UI\Command\AddCardToAssetCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param  AddCardToAssetCommand|BaseCommandInterface  $command
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws BindingResolutionException
     * @throws AssetNotFoundException
     * @throws CardAlreadyAddedException
     * @throws CardNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->service->addCard(
            $command->getUser(),
            $command->getAsset(),
            $command->getCard()
        );

        $this->resource = new NullResource();
    }
}