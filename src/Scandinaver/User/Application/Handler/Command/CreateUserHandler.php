<?php


namespace Scandinaver\User\Application\Handler\Command;

use Exception;
use Scandinaver\User\Domain\Contract\Command\CreateUserHandlerInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Command\CreateUserCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateUserHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class CreateUserHandler implements CreateUserHandlerInterface
{

    private UserService $service;

    /**
     * CreateUserHandler constructor.
     *
     * @param  UserService  $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  CreateUserCommand|Command  $command
     *
     * @throws Exception
     */
    public function handle($command): void
    {
        $this->service->registration($command->getData());
    }
} 