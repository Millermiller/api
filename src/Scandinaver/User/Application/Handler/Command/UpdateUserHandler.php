<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\User\Domain\Contract\Command\UpdateUserHandlerInterface;
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
     * @param $query UpdateUserCommand
     */
    public function handle($query): void
    {
        $this->userService->updateUser($query->getUser(), $query->getData());
    }
} 