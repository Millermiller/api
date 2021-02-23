<?php


namespace Scandinaver\User\Application\Handler\Query;

use Exception;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Contract\Query\UserStateHandlerInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Query\UserStateQuery;

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
     * @param  UserStateQuery|Query  $query
     *
     * @return array
     * @throws Exception
     */
    public function handle($query): array
    {
        return $this->userService->getState($query->getUser());
    }
}