<?php


namespace Scandinaver\Settings\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Command\DeleteSettingCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeleteSettingCommandHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Command
 */
class DeleteSettingCommandHandler extends AbstractHandler
{

    public function __construct(private SettingsService $settingsService)
    {
        parent::__construct();
    }

    /**
     * @param  DeleteSettingCommand  $command
     *
     * @throws SettingNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->settingsService->deleteSetting($command->getId());

        $this->resource = new NullResource();
    }
} 