<?php


namespace Scandinaver\Settings\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Settings\Domain\Services\SettingsService;
use Scandinaver\Settings\UI\Command\CreateSettingCommand;
use Scandinaver\Settings\UI\Resources\SettingTransformer;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\AbstractHandler;

/**
 * Class CreateSettingCommandHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Command
 */
class CreateSettingCommandHandler extends AbstractHandler
{

    private SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        parent::__construct();

        $this->settingsService = $settingsService;
    }

    /**
     * @param CreateSettingCommand|CommandInterface $command
     */
    public function handle($command): void
    {
        $setting = $this->settingsService->createSetting($command->getData());

        $this->resource = new Item($setting, new SettingTransformer());
    }
} 