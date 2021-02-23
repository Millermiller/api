<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Command\GiveNextLevelHandlerInterface;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Command\GiveNextLevelCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class GiveNextLevelHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GiveNextLevelHandler implements GiveNextLevelHandlerInterface
{
    private AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param  GiveNextLevelCommand|Command  $command
     */
    public function handle($command): void
    {
        $this->assetService->giveNextLevel($command->getUser(), $command->getAsset());
    }
}