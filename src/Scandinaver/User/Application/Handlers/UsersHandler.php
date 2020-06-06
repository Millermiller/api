<?php


namespace Scandinaver\User\Application\Handlers;

use Doctrine\Common\Collections\ArrayCollection;
use Scandinaver\User\Application\Query\UsersQuery;
use Scandinaver\User\Domain\Services\UserService;

/**
 * Class UsersHandler
 *
 * @package Scandinaver\User\Application\Handlers
 */
class UsersHandler implements UsersHandlerInterface
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UsersHandler constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param UsersQuery
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->userService->getAll();
    }
} 