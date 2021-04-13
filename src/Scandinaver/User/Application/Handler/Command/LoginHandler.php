<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Contract\Command\LoginHandlerInterface;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Command\LoginCommand;
use Scandinaver\User\UI\Resources\UserTransformer;

/**
 * Class LoginHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class LoginHandler extends AbstractHandler implements LoginHandlerInterface
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  LoginCommand|Query  $query
     *
     * @throws UserNotFoundException
     */
    public function handle($query): void
    {
        $user = $this->userService->login($query->getCredentials());

        $this->resource = new Item($user, new UserTransformer());
    }
}