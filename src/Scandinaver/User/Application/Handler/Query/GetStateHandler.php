<?php


namespace Scandinaver\User\Application\Handler\Query;

use Exception;
use Scandinaver\Shared\Contract\Query;
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
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param GetStateQuery|Query $query
     *
     * @return array
     * @throws Exception
     */
    public function handle($query): array
    {
        return $this->userService->getState($query->getUser(), $query->getLanguage());
    }
} 