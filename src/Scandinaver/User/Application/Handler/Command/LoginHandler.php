<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\User\Domain\Contract\Command\LoginHandlerInterface;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\Domain\Model\User;
use Scandinaver\User\UI\Command\LoginCommand;

/**
 * Class LoginHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class LoginHandler implements LoginHandlerInterface
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  LoginCommand  $query
     *
     * @return User
     * @throws UserNotFoundException
     */
    public function handle($query): ?User
    {
        return $this->userService->login($query->getCredentials());
    }
}