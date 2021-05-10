<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learn\Domain\Service\{AssetService};
use Scandinaver\Learn\UI\Command\DeleteAssetCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class DeleteAssetCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
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