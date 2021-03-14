<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\DeleteAssetHandlerInterface;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};
use Scandinaver\Learn\UI\Command\DeleteAssetCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class DeleteAssetHandler implements DeleteAssetHandlerInterface
{
    protected CardService $cardService;

    protected AssetService $assetService;

    public function __construct(AssetService $assetService, CardService $cardService)
    {
        $this->assetService = $assetService;

        $this->cardService = $cardService;
    }

    /**
     * @param  DeleteAssetCommand|Command  $command
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException
     */
    public function handle($command): void
    {
        $this->assetService->delete($command->getAsset());
    }
}