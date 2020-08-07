<?php


namespace Scandinaver\User\Application\Handler\Query;

use Exception;
use Scandinaver\User\Domain\Contract\Query\GetStateHandlerInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Query\GetStateQuery;

/**
 * Class GetStateHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class GetStateHandler implements GetStateHandlerInterface
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * GetStateHandler constructor.
     *
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  GetStateQuery  $query
     *
     * @return array
     * @throws Exception
     */
    public function handle($query): array
    {
        return $this->userService->getState($query->getUser(), $query->getLanguage());
    }
} 