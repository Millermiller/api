<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
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
     * @param  UpdateUserSettingsCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->service->updateUserInfo($command->getUser(), $command->getData());

        $this->resource = new NullResource();
    }
} 