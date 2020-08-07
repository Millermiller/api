<?php


namespace Scandinaver\User\Application\Handler\Query;

use Scandinaver\User\Domain\Contract\Query\UsersHandlerInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Query\UsersQuery;

/**
 * Class UsersHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class UsersHandler implements UsersHandlerInterface
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * UsersHandler constructor.
     *
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  UsersQuery
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->userService->getAll();
    }
} 