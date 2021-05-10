<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;
use Scandinaver\User\Domain\Service\UserService;
use Scandinaver\User\UI\Command\UpdateUserCommand;
use Scandinaver\User\UI\Resource\UserTransformer;

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
     * @param  UpdateUserCommand|BaseCommandInterface  $command
     *
     * @throws UserNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $user = $this->userService->updateUser($command->getUser(), $command->getData());

        $this->resource = new Item($user, new UserTransformer());
    }
} 