<?php


namespace Scandinaver\User\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Query\UsersQuery;
use Scandinaver\User\UI\Resources\UserTransformer;

/**
 * Class UsersQueryHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class UsersQueryHandler extends AbstractHandler
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  UsersQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        $users = $this->userService->all();

        $this->resource = new Collection($users, new UserTransformer());
    }
} 