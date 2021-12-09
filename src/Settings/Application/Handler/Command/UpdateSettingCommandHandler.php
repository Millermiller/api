<?php


namespace Scandinaver\Settings\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Command\UpdateSettingCommand;
use Scandinaver\Settings\UI\Resource\SettingTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateSettingCommandHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Command
 */
class UpdateSettingCommandHandler extends AbstractHandler
{

    public function __construct(private SettingsService $settingsService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|UpdateSettingCommand  $command
     *
     * @throws SettingNotFoundException
     */
    public function handle(CommandInterface|UpdateSettingCommand $command): void
    {
        $setting = $this->settingsService->updateSetting($command->getId(), $command->getData());

        $this->resource = new Item($setting, new SettingTransformer());
    }
} 