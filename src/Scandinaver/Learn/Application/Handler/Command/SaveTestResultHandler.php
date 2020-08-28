<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use App\Events\TestResultSaved;
use App\Helpers\Auth;
use Scandinaver\Learn\Domain\Contract\Command\SaveTestResultHandlerInterface;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Command\SaveTestResultCommand;

/**
 * Class SaveTestResultHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class SaveTestResultHandler implements SaveTestResultHandlerInterface
{
    private AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param  SaveTestResultCommand  $command
     */
    public function handle($command): void
    {
        $result = $this->assetService->saveTestResult($command->getUser(), $command->getAsset(),
            $command->getResultValue());

        event(new TestResultSaved(Auth::user(), $result));
    }
}