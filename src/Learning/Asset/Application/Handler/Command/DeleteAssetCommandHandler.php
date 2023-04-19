<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\{AssetService};
use Scandinaver\Learning\Asset\UI\Command\DeleteAssetCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Throwable;

/**
 * Class DeleteAssetCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class DeleteAssetCommandHandler extends AbstractHandler
{

    public function __construct(protected AssetService $assetService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|DeleteAssetCommand  $command
     *
     * @throws AssetNotFoundException
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function handle(CommandInterface|DeleteAssetCommand $command): void
    {
        $this->assetService->delete($command->getUser(), $command->getAsset());

        $this->resource = new NullResource();
    }
}