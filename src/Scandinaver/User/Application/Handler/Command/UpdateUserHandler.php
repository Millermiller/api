<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Contract\Command\UpdateUserHandlerInterface;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Command\UpdateUserCommand;
use Scandinaver\User\UI\Resources\UserTransformer;

/**
 * Class UpdateUserHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class UpdateUserHandler extends AbstractHandler implements UpdateUserHandlerInterface
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  UpdateUserCommand|Command  $command
     *
     * @throws UserNotFoundException
     */
    public function handle($command): void
    {
        $user = $this->userService->updateUser($command->getUser(), $command->getData());

        $this->resource = new Item($user, new UserTransformer());
    }
} 