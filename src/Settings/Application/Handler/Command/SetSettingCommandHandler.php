<?php


namespace Scandinaver\Settings\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Command\SetSettingCommand;
use Scandinaver\Settings\UI\Resource\SettingTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class SetSettingCommandHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Command
 */
class SetSettingCommandHandler extends AbstractHandler
{

    public function __construct(private SettingsService $settingsService)
    {
        parent::__construct();
    }

    /**
     * @param  SetSettingCommand  $command
     *
     * @throws SettingNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $setting = $this->settingsService->setValue($command->getId(), $command->getValue());

        $this->resource = new Item($setting, new SettingTransformer());
    }
} 