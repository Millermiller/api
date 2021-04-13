<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Contract\Command\DeleteCardFromAssetHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Command\DeleteCardFromAssetCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class DeleteCardFromAssetHandler extends AbstractHandler implements DeleteCardFromAssetHandlerInterface
{
    protected AssetService $service;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->service = $assetService;
    }

    /**
     * @param  DeleteCardFromAssetCommand|Command  $command
     *
     * @throws AssetNotFoundException
     * @throws CardNotFoundException
     */
    public function handle($command): void
    {
        $this->service->removeCard($command->getAsset(), $command->getCard());

        $this->resource = new NullResource();
    }
}