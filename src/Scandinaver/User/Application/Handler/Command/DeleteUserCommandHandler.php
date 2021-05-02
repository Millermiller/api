<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;
use Scandinaver\User\Domain\Service\UserService;
use Scandinaver\User\UI\Command\DeleteUserCommand;

/**
 * Class DeleteUserCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class DeleteUserCommandHandler extends AbstractHandler
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  DeleteUserCommand|CommandInterface  $command
     *
     * @throws UserNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->userService->delete($command->getUser());

        $this->resource = new NullResource();
    }
} 