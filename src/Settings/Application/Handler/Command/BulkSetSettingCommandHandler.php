<?php


namespace Scandinaver\Settings\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Command\BulkSetSettingCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class BulkSetSettingCommandHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Command
 */
class BulkSetSettingCommandHandler extends AbstractHandler
{

    public function __construct(private SettingsService $settingsService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|BulkSetSettingCommand  $command
     *
     * @throws SettingNotFoundException
     */
    public function handle(CommandInterface|BulkSetSettingCommand $command): void
    {
        $this->settingsService->bulkSetValue($command->getData());

        $this->resource = new NullResource();
    }
} 