<?php


namespace Scandinaver\User\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Contract\Query\GetUserHandlerInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Query\GetUserQuery;
use Scandinaver\User\UI\Resources\UserTransformer;

/**
 * Class GetUserHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class GetUserHandler extends AbstractHandler implements GetUserHandlerInterface
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  GetUserQuery|Query  $query
     */
    public function handle($query): void
    {
        $user = $this->userService->getInfo();

        $this->resource = new Item($user, new UserTransformer());
    }
} 