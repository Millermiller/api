<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Shared\AbstractHandler;
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
class DeleteUserHandler extends AbstractHandler implements DeleteUserHandlerInterface
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

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

        $this->resource = new NullResource();
    }
} 