<?php


namespace Scandinaver\User\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;
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

    public function __construct(protected UserService $userService)
    {
        parent::__construct();
    }

    public function handle(BaseCommandInterface|GetUserQuery $query): void
    {
        $user = $this->userService->getInfo($query->getUser());

        $includes = $query->getIncludes();
        if (in_array('roles', $includes)) {
            $this->fractal->parseIncludes('roles');
        }

        $this->resource = new Item($user, new UserTransformer());
    }
} 