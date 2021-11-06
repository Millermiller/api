<?php


namespace Scandinaver\Settings\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Command\BulkSetSettingCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param  BulkSetSettingCommand|BaseCommandInterface  $command
     *
     * @throws SettingNotFoundException
     */
    public function handle(BaseCommandInterface$command): void
    {
        $this->settingsService->bulkSetValue($command->getData());

        $this->resource = new NullResource();
    }
} 