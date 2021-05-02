<?php


namespace Scandinaver\Settings\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Services\SettingsService;
use Scandinaver\Settings\UI\Command\BulkSetSettingCommand;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\AbstractHandler;

/**
 * Class BulkSetSettingCommandHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Command
 */
class BulkSetSettingCommandHandler extends AbstractHandler
{

    private SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        parent::__construct();

        $this->settingsService = $settingsService;
    }

    /**
     * @param  BulkSetSettingCommand|CommandInterface  $command
     *
     * @throws SettingNotFoundException
     */
    public function handle($command): void
    {
        $this->settingsService->bulkSetValue($command->getData());

        $this->resource = new NullResource();
    }
} 