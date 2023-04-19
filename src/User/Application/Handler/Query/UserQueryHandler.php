<?php


namespace Scandinaver\User\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;
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

    public function __construct(private UserService $userService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|UserQuery  $query
     *
     * @throws UserNotFoundException
     */
    public function handle(BaseCommandInterface|UserQuery $query): void
    {
        $user = $this->userService->one($query->getUserId());

        $includes = $query->getIncludes();
        if (in_array('roles', $includes)) {
            $this->fractal->parseIncludes('roles');
        }

        $this->resource = new Item($user, new UserTransformer(), 'users');
    }
} 