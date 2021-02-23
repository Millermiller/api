<?php


namespace Scandinaver\User\Application\Handler\Command;

use Exception;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Contract\Command\CreateUserHandlerInterface;
use Scandinaver\User\Domain\Model\User;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Command\CreateUserCommand;

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
     * @return User
     * @throws Exception
     */
    public function handle($command): User
    {
        return $this->service->registration($command->getData());
    }
} 