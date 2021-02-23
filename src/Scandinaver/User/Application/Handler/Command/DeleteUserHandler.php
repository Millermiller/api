<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Contract\Command\DeleteUserHandlerInterface;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Command\DeleteUserCommand;

/**
 * Class DeleteUserHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class DeleteUserHandler implements DeleteUserHandlerInterface
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  DeleteUserCommand|Command  $command
     *
     * @throws UserNotFoundException
     */
    public function handle($command): void
    {
        $this->userService->delete($command->getUser());
    }
} 