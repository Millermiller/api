<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Command\UpdateUserCommand;
use Scandinaver\User\UI\Resources\UserTransformer;

/**
 * Class UpdateUserCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class UpdateUserCommandHandler extends AbstractHandler
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  UpdateUserCommand|CommandInterface  $command
     *
     * @throws UserNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $user = $this->userService->updateUser($command->getUser(), $command->getData());

        $this->resource = new Item($user, new UserTransformer());
    }
} 