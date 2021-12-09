<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\TestService;
use Scandinaver\Learning\Asset\UI\Command\CompleteTestCommand;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CompleteTestCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class CompleteTestCommandHandler extends AbstractHandler
{

    public function __construct(private TestService $service)
    {
        parent::__construct();
    }

    /**
     * @throws AssetNotFoundException
     * @throws SettingNotFoundException
     */
    public function handle(CommandInterface|CompleteTestCommand $command): void
    {
        $this->service->savePassing(
            $command->getUser(),
            $command->getAsset(),
            $command->getData()
        );

        $this->resource = new NullResource();
    }
}