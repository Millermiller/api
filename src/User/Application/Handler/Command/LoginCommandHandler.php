<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;
use Scandinaver\User\Domain\Service\UserService;
use Scandinaver\User\UI\Command\LoginCommand;
use Scandinaver\User\UI\Resource\UserTransformer;

/**
 * Class LoginCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class LoginCommandHandler extends AbstractHandler
{

    public function __construct(protected UserService $userService)
    {
        parent::__construct();
    }

    /**
     * @param  LoginCommand  $command
     *
     * @throws UserNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $user = $this->userService->login($command->getCredentials());

        $this->resource = new Item($user, new UserTransformer(), 'user');
    }
}