<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Service\{AssetService};
use Scandinaver\Learn\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learn\UI\Command\DeleteAssetCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

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
     * @param  DeleteAssetCommand|CommandInterface  $command
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws BindingResolutionException
     * @throws AssetNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->assetService->delete($command->getAsset());

        $this->resource = new NullResource();
    }
}