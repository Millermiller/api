<?php


namespace Scandinaver\User\Application\Handler\Query;

use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Contract\Query\UserHandlerInterface;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\Model\UserDTO;
use Scandinaver\User\Domain\Services\UserService;
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
     * @param  UserQuery|Query  $query
     *
     * @return UserDTO
     * @throws UserNotFoundException
     */
    public function handle($query): UserDTO
    {
        return $this->userService->getOne($query->getKey());
    }
} 