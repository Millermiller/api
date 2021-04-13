<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Contract\Command\UpdateAssetHandlerInteface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Command\UpdateAssetCommand;
use Scandinaver\Learn\UI\Resources\AssetDTOTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UpdateAssetHandler extends AbstractHandler implements UpdateAssetHandlerInteface
{
    protected AssetService $assetService;

    /**
     * AssetController constructor.
     *
     * @param  AssetService  $assetService
     */
    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->assetService = $assetService;
    }

    /**
     * @param  UpdateAssetCommand|Command  $command
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws BindingResolutionException
     * @throws AssetNotFoundException
     */
    public function handle($command): void
    {
        $asset = $this->assetService->updateAsset($command->getUser(), $command->getAsset(), $command->getData());

        $this->resource = new Item($asset, new AssetDTOTransformer());
    }
}