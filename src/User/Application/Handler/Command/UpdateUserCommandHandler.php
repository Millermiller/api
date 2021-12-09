<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
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

    public function __construct(private UserService $userService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|UpdateUserCommand  $command
     *
     * @throws UserNotFoundException
     */
    public function handle(CommandInterface|UpdateUserCommand $command): void
    {
        $user = $this->userService->updateUser($command->getUser(), $command->getData());

        $this->resource = new Item($user, new UserTransformer());
    }
} 