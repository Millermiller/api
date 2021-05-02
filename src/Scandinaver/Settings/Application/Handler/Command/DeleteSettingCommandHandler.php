<?php


namespace Scandinaver\Settings\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Command\DeleteSettingCommand;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\AbstractHandler;

/**
 * Class DeleteSettingCommandHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Command
 */
class DeleteSettingCommandHandler extends AbstractHandler
{

    private SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        parent::__construct();

        $this->settingsService = $settingsService;
    }

    /**
     * @param  DeleteSettingCommand|CommandInterface  $command
     *
     * @throws SettingNotFoundException
     */
    public function handle($command): void
    {
        $this->settingsService->deleteSetting($command->getId());

        $this->resource = new NullResource();
    }
} 