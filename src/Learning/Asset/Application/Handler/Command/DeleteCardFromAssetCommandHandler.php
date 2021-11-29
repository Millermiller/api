<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learning\Asset\Domain\Exception\CardNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;
use Scandinaver\Learning\Asset\UI\Command\DeleteCardFromAssetCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeleteCardFromAssetCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class DeleteCardFromAssetCommandHandler extends AbstractHandler
{

    public function __construct(protected AssetService $assetService)
    {
        parent::__construct();
    }

    /**
     * @param  DeleteCardFromAssetCommand  $command
     *
     * @throws AssetNotFoundException
     * @throws CardNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->assetService->removeCard($command->getAsset(), $command->getCard());

        $this->resource = new NullResource();
    }
}