<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\TestService;
use Scandinaver\Learning\Asset\UI\Command\CompleteTestCommand;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CompleteTestCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class CompleteTestCommandHandler extends AbstractHandler
{
    private TestService $testService;

    public function __construct(TestService $testService)
    {
        parent::__construct();

        $this->testService = $testService;
    }

    /**
     * @param  CompleteTestCommand|BaseCommandInterface  $command
     *
     * @throws AssetNotFoundException
     * @throws SettingNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->testService->savePassing(
            $command->getUser(),
            $command->getAsset(),
            $command->getData()
        );

        $this->resource = new NullResource();
    }
}