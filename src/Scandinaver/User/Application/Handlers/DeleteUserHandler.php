<?php


namespace Scandinaver\User\Application\Handlers;

use Scandinaver\User\Application\Commands\DeleteUserCommand;
use Scandinaver\User\Domain\Services\UserService;

/**
 * Class DeleteUserHandler
 *
 * @package Scandinaver\User\Application\Handlers
 */
class DeleteUserHandler implements DeleteUserHandlerInterface
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserHandler constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param $command DeleteUserCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->userService->delete($command->getUser());
    }
} 