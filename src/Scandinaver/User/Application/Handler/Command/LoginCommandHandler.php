<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Command\LoginCommand;
use Scandinaver\User\UI\Resources\UserTransformer;

/**
 * Class LoginCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class LoginCommandHandler extends AbstractHandler
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  LoginCommand|CommandInterface  $command
     *
     * @throws UserNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $user = $this->userService->login($command->getCredentials());

        $this->resource = new Item($user, new UserTransformer());
    }
}