<?php


namespace Scandinaver\User\Application\Handlers;

use Scandinaver\User\Application\Query\UserQuery;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\Domain\User;

/**
 * Class UserHandler
 *
 * @package Scandinaver\User\Application\Handlers
 */
class UserHandler implements UserHandlerInterface
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserHandler constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param UserQuery
     *
     * @return User
     */
    public function handle($query): User
    {
        return $this->userService->getOne($query->getKey());
    }
} 