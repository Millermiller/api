<?php


namespace Scandinaver\User\Application\Handlers;

use Exception;
use Scandinaver\User\Application\Query\UserStateQuery;
use Scandinaver\User\Domain\Services\UserService;

/**
 * Class UserStateHandler
 * @package Scandinaver\User\Application\Handlers
 */
class UserStateHandler implements UserStateHandlerInterface
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
     * @param UserStateQuery $query
     * @return array
     * @throws Exception
     */
    public function handle($query): array
    {
        return $this->userService->getState($query->getUser());
    }
}