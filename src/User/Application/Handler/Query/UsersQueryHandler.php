<?php


namespace Scandinaver\User\Application\Handler\Query;

use Doctrine\ORM\Query\QueryException;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;
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

    public function __construct(private UserService $userService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|UsersQuery  $query
     *
     * @throws QueryException
     */
    public function handle(BaseCommandInterface|UsersQuery $query): void
    {
        $data = $this->userService->paginate($query->getParameters());

        $includes = $query->getIncludes();
        if (in_array('roles', $includes)) {
            $this->fractal->parseIncludes('roles');
        }

        $this->resource = new Collection($data->items(), new UserTransformer());

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));

    }
} 