<?php


namespace Scandinaver\User\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Service\UserService;
use Scandinaver\User\UI\Query\GetUserQuery;
use Scandinaver\User\UI\Resource\UserTransformer;

/**
 * Class GetUserQueryHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class GetUserQueryHandler extends AbstractHandler
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  GetUserQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        $user = $this->userService->getInfo();

        $this->resource = new Item($user, new UserTransformer());
    }
} 