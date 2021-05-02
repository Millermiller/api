<?php


namespace Scandinaver\Settings\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Command\UpdateSettingCommand;
use Scandinaver\Settings\UI\Resource\SettingTransformer;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\AbstractHandler;

/**
 * Class UpdateSettingCommandHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Command
 */
class UpdateSettingCommandHandler extends AbstractHandler
{

    private SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        parent::__construct();

        $this->settingsService = $settingsService;
    }

    /**
     * @param  UpdateSettingCommand|CommandInterface  $command
     *
     * @throws SettingNotFoundException
     */
    public function handle($command): void
    {
        $setting = $this->settingsService->updateSetting($command->getId(), $command->getData());

        $this->resource = new Item($setting, new SettingTransformer());
    }
} 