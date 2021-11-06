<?php


namespace Scandinaver\Settings\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Command\CreateSettingCommand;
use Scandinaver\Settings\UI\Resource\SettingTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param CreateSettingCommand|BaseCommandInterface $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        $setting = $this->settingsService->createSetting($command->buildDTO());

        $this->resource = new Item($setting, new SettingTransformer());
    }
} 