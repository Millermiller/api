<?php


namespace Scandinaver\User\Application\Handler\Query;

use Exception;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Contract\Query\UserStateHandlerInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Query\UserStateQuery;

/**
 * Class UserStateHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class UserStateHandler extends AbstractHandler implements UserStateHandlerInterface
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  UserStateQuery|Query  $query
     *
     * @throws Exception
     */
    public function handle($query): void
    {
        $stateDTO = $this->userService->getState($query->getUser());
    }
}