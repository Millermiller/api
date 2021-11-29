<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;
use Scandinaver\Learning\Asset\UI\Command\UpdateAssetCommand;
use Scandinaver\Learning\Asset\UI\Resource\AssetTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateAssetCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class UpdateAssetCommandHandler extends AbstractHandler
{

    public function __construct(protected AssetService $assetService)
    {
        parent::__construct();
    }

    /**
     * @param  UpdateAssetCommand  $command
     *
     * @throws AssetNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $asset = $this->assetService->updateAsset($command->getUser(), $command->getAsset(), $command->getData());

        $this->resource = new Item($asset, new AssetTransformer());
    }
}