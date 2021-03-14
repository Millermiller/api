<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Learn\Domain\Contract\Command\AddCardToAssetHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\CardAlreadyAddedException;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\Domain\Model\AssetDTO;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Command\AddCardToAssetCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class AddCardToAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class AddCardToAssetHandler implements AddCardToAssetHandlerInterface
{
    protected AssetService $service;

    public function __construct(AssetService $assetService)
    {
        $this->service = $assetService;
    }

    /**
     * @param  AddCardToAssetCommand|Command  $command
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws BindingResolutionException
     * @throws AssetNotFoundException
     * @throws CardAlreadyAddedException
     * @throws CardNotFoundException
     */
    public function handle($command): void
    {
        $this->service->addCard(
            $command->getUser(),
            $command->getAsset(),
            $command->getCard()
        );
    }
}