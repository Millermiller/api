<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
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

    public function __construct(private UserService $userService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|DeleteUserCommand  $command
     *
     * @throws UserNotFoundException
     */
    public function handle(CommandInterface|DeleteUserCommand $command): void
    {
        $this->userService->delete($command->getUser());

        $this->resource = new NullResource();
    }
} 