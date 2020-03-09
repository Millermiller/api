<?php


namespace Scandinaver\User\Application\Handlers;

use Scandinaver\User\Application\Commands\UpdateUserCommand;
use Scandinaver\User\Application\Query\UserQuery;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\Domain\User;

/**
 * Class UpdateUserHandler
 * @package Scandinaver\User\Application\Handlers
 */
class UpdateUserHandler implements UpdateUserHandlerInterface
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserHandler constructor.
     * @param UserService $userService
     */
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