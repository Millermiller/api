<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use App\Events\NextLevel;
use Scandinaver\Learn\Domain\Contract\Command\GiveNextLevelHandlerInterface;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Command\GiveNextLevelCommand;

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
     * @param  GiveNextLevelCommand  $command
     */
    public function handle($command): void
    {
        $nextAsset = $this->assetService->giveNextLevel($command->getUser(), $command->getAsset());
        //  event(new NextLevel($command->getUser(), $nextAsset));
    }
}