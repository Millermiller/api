<?php


namespace Scandinaver\User\Application\Handler\Query;

use Scandinaver\User\Domain\Contract\Query\GetUserHandlerInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Query\GetUserQuery;

/**
 * Class GetUserHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class GetUserHandler implements GetUserHandlerInterface
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  GetUserQuery
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->userService->getInfo();
    }
} 