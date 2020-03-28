<?php


namespace Scandinaver\User\Application\Handlers;

use Scandinaver\User\Application\Query\GetUserQuery;
use Scandinaver\User\Domain\Services\UserService;

/**
 * Class GetUserHandler
 *
 * @package Scandinaver\User\Application\Handlers
 */
class GetUserHandler implements GetUserHandlerInterface
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
     * @param GetUserQuery
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->userService->getInfo();
    }
} 