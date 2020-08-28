<?php


namespace Scandinaver\User\Application\Handler\Query;

use Exception;
use Scandinaver\User\Domain\Contract\Query\UserStateHandlerInterface;
use Scandinaver\User\UI\Query\UserStateQuery;
use Scandinaver\User\Domain\Services\UserService;

/**
 * Class UserStateHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class UserStateHandler implements UserStateHandlerInterface
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  UserStateQuery  $query
     *
     * @return array
     * @throws Exception
     */
    public function handle($query): array
    {
        return $this->userService->getState($query->getUser());
    }
}