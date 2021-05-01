<?php


namespace Scandinaver\User\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Query\UserQuery;
use Scandinaver\User\UI\Resources\UserTransformer;

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
     * @param  UserQuery|CommandInterface  $query
     *
     * @throws UserNotFoundException
     */
    public function handle(CommandInterface $query): void
    {
        $user = $this->userService->one($query->getKey());

        $this->resource = new Item($user, new UserTransformer());
    }
} 