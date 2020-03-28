<?php


namespace Scandinaver\User\Application\Handlers;

use Scandinaver\User\Application\Query\LoginQuery;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\Domain\User;

/**
 * Class LoginHandler
 *
 * @package Scandinaver\User\Application\Handlers
 */
class LoginHandler implements LoginHandlerInterface
{
    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param LoginQuery $query
     *
     * @return User
     * @throws UserNotFoundException
     */
    public function handle($query): User
    {
        return $this->userService->login($query->getCredentials());
    }
}