<?php


namespace Scandinaver\User\Application\Handler\Query;

use Scandinaver\User\Domain\Contract\Query\UserHandlerInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\Domain\Model\User;
use Scandinaver\User\UI\Query\UserQuery;

/**
 * Class UserHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class UserHandler implements UserHandlerInterface
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  UserQuery
     *
     * @return User
     */
    public function handle($query): User
    {
        return $this->userService->getOne($query->getKey());
    }
} 