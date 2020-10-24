<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Exception;
use Scandinaver\Learn\Domain\Contract\Command\AddBasicLevelHandlerInterface;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Command\AddBasicLevelCommand;

/**
 * Class AddBasicLevelHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class AddBasicLevelHandler implements AddBasicLevelHandlerInterface
{
    protected AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param  AddBasicLevelCommand  $command
     *
     * @throws Exception
     */
    public function handle($command): void
    {
        $this->assetService->addBasic($command->getLanguage(), $command->getType());
    }
} 