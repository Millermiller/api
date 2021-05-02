<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Service\UserService;
use Scandinaver\User\UI\Command\UpdateUserSettingsCommand;

/**
 * Class UpdateUserSettingsCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class UpdateUserSettingsCommandHandler extends AbstractHandler
{

    private UserService $service;

    public function __construct(UserService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdateUserSettingsCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->updateUserInfo($command->getUser(), $command->getData());

        $this->resource = new NullResource();
    }
} 