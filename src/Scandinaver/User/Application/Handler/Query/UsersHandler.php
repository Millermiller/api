<?php


namespace Scandinaver\User\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Contract\Query\UsersHandlerInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Query\UsersQuery;
use Scandinaver\User\UI\Resources\UserTransformer;

/**
 * Class UsersHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class UsersHandler extends AbstractHandler implements UsersHandlerInterface
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  UsersQuery|Query  $query
     */
    public function handle($query): void
    {
        $users = $this->userService->all();

        $this->resource = new Collection($users, new UserTransformer());
    }
} 