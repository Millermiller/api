<?php


namespace Scandinaver\User\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;
use Scandinaver\User\Domain\Service\UserService;
use Scandinaver\User\UI\Query\UserQuery;
use Scandinaver\User\UI\Resource\UserTransformer;

/**
 * Class UserHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class UserQueryHandler extends AbstractHandler
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  UserQuery|BaseCommandInterface  $query
     *
     * @throws UserNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $user = $this->userService->one($query->getUserId());

        $includes = $query->getIncludes();
        if (in_array('roles', $includes)) {
            $this->fractal->parseIncludes('roles');
        }

        $this->resource = new Item($user, new UserTransformer());
    }
} 