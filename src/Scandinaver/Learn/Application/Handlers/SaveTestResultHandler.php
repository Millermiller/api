<?php


namespace Scandinaver\Learn\Application\Handlers;

use App\Events\TestResultSaved;
use App\Helpers\Auth;
use Scandinaver\Learn\Application\Commands\SaveTestResultCommand;
use Scandinaver\Learn\Domain\Services\AssetService;

/**
 * Class SaveTestResultHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class SaveTestResultHandler implements SaveTestResultHandlerInterface
{
    /**
     * @var AssetService
     */
    private $assetService;

    /**
     * SaveTestResultHandler constructor.
     *
     * @param AssetService $assetService
     */
    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param SaveTestResultCommand $command
     */
    public function handle($command): void
    {
        $result = $this->assetService->saveTestResult($command->getUser(), $command->getAsset(), $command->getResultValue());

        event(new TestResultSaved(Auth::user(), $result));
    }
}