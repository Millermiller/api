<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Learn\Domain\Contract\Command\UpdateAssetHandlerInteface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Model\AssetDTO;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};
use Scandinaver\Learn\UI\Command\UpdateAssetCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UpdateAssetHandler implements UpdateAssetHandlerInteface
{
    protected CardService $cardService;

    protected AssetService $assetService;

    /**
     * AssetController constructor.
     *
     * @param  AssetService  $assetService
     * @param  CardService   $cardService
     */
    public function __construct(AssetService $assetService, CardService $cardService)
    {
        $this->assetService = $assetService;

        $this->cardService = $cardService;
    }

    /**
     * @param  UpdateAssetCommand|Command  $command
     *
     * @return AssetDTO
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws BindingResolutionException
     * @throws AssetNotFoundException
     */
    public function handle($command): AssetDTO
    {
        return $this->assetService->updateAsset($command->getAsset(), $command->getData());

    }
}