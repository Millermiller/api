<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Contract\Command\UpdateUserHandlerInterface;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\Model\UserDTO;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Command\UpdateUserCommand;

/**
 * Class UpdateUserHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class UpdateUserHandler implements UpdateUserHandlerInterface
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  UpdateUserCommand|Command  $command
     *
     * @return UserDTO
     * @throws UserNotFoundException
     */
    public function handle($command): UserDTO
    {
        return $this->userService->updateUser($command->getUser(), $command->getData());
    }
} 