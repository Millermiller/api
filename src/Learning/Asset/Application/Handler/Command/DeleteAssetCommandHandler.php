<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\{AssetService};
use Scandinaver\Learning\Asset\UI\Command\DeleteAssetCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class DeleteAssetCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class DeleteAssetCommandHandler extends AbstractHandler
{
    protected AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->assetService = $assetService;
    }

    /**
     * @param  DeleteAssetCommand|BaseCommandInterface  $command
     *
     * @throws BindingResolutionException
     * @throws AssetNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->assetService->delete($command->getAsset());

        $this->resource = new NullResource();
    }
}