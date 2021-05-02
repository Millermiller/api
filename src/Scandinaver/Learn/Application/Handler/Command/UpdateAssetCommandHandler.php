<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learn\Domain\Service\AssetService;
use Scandinaver\Learn\UI\Command\UpdateAssetCommand;
use Scandinaver\Learn\UI\Resource\AssetDTOTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateAssetCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UpdateAssetCommandHandler extends AbstractHandler
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
     * @param  UpdateAssetCommand|CommandInterface  $command
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws BindingResolutionException
     * @throws AssetNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $asset = $this->assetService->updateAsset($command->getUser(), $command->getAsset(), $command->getData());

        $this->resource = new Item($asset, new AssetDTOTransformer());
    }
}