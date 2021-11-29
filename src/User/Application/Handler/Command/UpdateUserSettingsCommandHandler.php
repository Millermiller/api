<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\User\Domain\Service\UserService;
use Scandinaver\User\UI\Command\UpdateUserSettingsCommand;

/**
 * Class UpdateUserSettingsCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class UpdateUserSettingsCommandHandler extends AbstractHandler
{

    public function __construct(private UserService $service)
    {
        parent::__construct();
    }

    /**
     * @param  UpdateUserSettingsCommand  $command
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->updateUserInfo($command->getUser(), $command->getData());

        $this->resource = new NullResource();
    }
} 