<?php


namespace Scandinaver\User\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\User\Domain\Service\UserService;
use Scandinaver\User\UI\Query\UsersQuery;
use Scandinaver\User\UI\Resource\UserTransformer;

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
     * @param  UsersQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $users = $this->userService->all();

        $includes = $query->getIncludes();
        if (in_array('roles', $includes)) {
            $this->fractal->parseIncludes('roles');
        }

        $this->resource = new Collection($users, new UserTransformer());
    }
} 