<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learn\Domain\Exception\CardNotFoundException;
use Scandinaver\Learn\Domain\Service\AssetService;
use Scandinaver\Learn\UI\Command\DeleteCardFromAssetCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class DeleteCardFromAssetCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class DeleteCardFromAssetCommandHandler extends AbstractHandler
{
    protected AssetService $service;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->service = $assetService;
    }

    /**
     * @param  DeleteCardFromAssetCommand|BaseCommandInterface  $command
     *
     * @throws AssetNotFoundException
     * @throws CardNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->service->removeCard($command->getAsset(), $command->getCard());

        $this->resource = new NullResource();
    }
}