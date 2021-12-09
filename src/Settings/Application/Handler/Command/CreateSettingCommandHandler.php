<?php


namespace Scandinaver\Settings\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Command\CreateSettingCommand;
use Scandinaver\Settings\UI\Resource\SettingTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateSettingCommandHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Command
 */
class CreateSettingCommandHandler extends AbstractHandler
{

    public function __construct(private SettingsService $settingsService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|CreateSettingCommand  $command
     */
    public function handle(CommandInterface|CreateSettingCommand $command): void
    {
        $setting = $this->settingsService->createSetting($command->buildDTO());

        $this->resource = new Item($setting, new SettingTransformer());
    }
} 