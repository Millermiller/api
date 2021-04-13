<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Contract\Command\UpdateUserSettingsHandlerInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Command\UpdateUserSettingsCommand;

/**
 * Class UpdateUserSettingsHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class UpdateUserSettingsHandler extends AbstractHandler implements UpdateUserSettingsHandlerInterface
{

    private UserService $service;

    public function __construct(UserService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdateUserSettingsCommand|Command  $command
     */
    public function handle($command): void
    {
        $this->service->updateUserInfo($command->getUser(), $command->getData());

        $this->resource = new NullResource();
    }
} 