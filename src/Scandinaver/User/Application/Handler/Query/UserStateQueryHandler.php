<?php


namespace Scandinaver\User\Application\Handler\Query;

use Exception;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Query\UserStateQuery;

/**
 * Class UserStateQueryHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class UserStateQueryHandler extends AbstractHandler
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  UserStateQuery|CommandInterface  $query
     *
     * @throws Exception
     */
    public function handle(CommandInterface $query): void
    {
        $stateDTO = $this->userService->getState($query->getUser());
    }
}