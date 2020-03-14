<?php


namespace Scandinaver\User\Application\Handlers;

use Exception;
use Scandinaver\User\Application\Query\GetStateQuery;
use Scandinaver\User\Domain\Services\UserService;

/**
 * Class GetStateHandler
 * @package Scandinaver\User\Application\Handlers
 */
class GetStateHandler implements GetStateHandlerInterface
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
     * @param GetStateQuery
     * @return array
     * @throws Exception
     */
    public function handle($query): array
    {
        return $this->userService->getState($query->getUser());
    }
} 