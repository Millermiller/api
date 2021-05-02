<?php


namespace Scandinaver\Settings\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Services\SettingsService;
use Scandinaver\Settings\UI\Command\SetSettingCommand;
use Scandinaver\Settings\UI\Resources\SettingTransformer;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\AbstractHandler;

/**
 * Class SetSettingCommandHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Command
 */
class SetSettingCommandHandler extends AbstractHandler
{

    private SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        parent::__construct();

        $this->settingsService = $settingsService;
    }

    /**
     * @param  SetSettingCommand|CommandInterface  $command
     *
     * @throws SettingNotFoundException
     */
    public function handle($command): void
    {
        $setting = $this->settingsService->setValue($command->getId(), $command->getValue());

        $this->resource = new Item($setting, new SettingTransformer());
    }
} 