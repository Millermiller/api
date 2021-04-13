<?php


namespace Scandinaver\User\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Contract\Query\UserHandlerInterface;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Query\UserQuery;
use Scandinaver\User\UI\Resources\UserTransformer;

/**
 * Class UserHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class UserHandler extends AbstractHandler implements UserHandlerInterface
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  UserQuery|Query  $query
     *
     * @throws UserNotFoundException
     */
    public function handle($query): void
    {
        $user = $this->userService->one($query->getKey());

        $this->resource = new Item($user, new UserTransformer());
    }
} 