<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Contract\Command\DeleteAssetHandlerInterface;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\UI\Command\DeleteAssetCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class DeleteAssetHandler extends AbstractHandler implements DeleteAssetHandlerInterface
{
    protected AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->assetService = $assetService;
    }

    /**
     * @param  DeleteAssetCommand|Command  $command
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws BindingResolutionException
     * @throws AssetNotFoundException
     */
    public function handle($command): void
    {
        $this->assetService->delete($command->getAsset());

        $this->resource = new NullResource();
    }
}