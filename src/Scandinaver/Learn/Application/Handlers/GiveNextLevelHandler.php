<?php


namespace Scandinaver\Learn\Application\Handlers;

use App\Events\NextLevel;
use Scandinaver\Learn\Application\Commands\GiveNextLevelCommand;
use Scandinaver\Learn\Domain\Services\AssetService;

/**
 * Class GiveNextLevelHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class GiveNextLevelHandler implements GiveNextLevelHandlerInterface
{
    /**
     * @var AssetService
     */
    private $assetService;

    /**
     * GiveNextLevelHandler constructor.
     *
     * @param AssetService $assetService
     */
    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param GiveNextLevelCommand $command
     */
    public function handle($command): void
    {
        $nextAsset = $this->assetService->giveNextLevel($command->getUser(), $command->getAsset());

        event(new NextLevel($command->getUser(), $nextAsset));
    }
}