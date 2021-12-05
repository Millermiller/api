<?php


namespace Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;
use Scandinaver\RBAC\Domain\Entity\Role;

/**
 * Class RoleRepository
 *
 * @package Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\Repository
 */
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    use PaginatesFromParams;

    /**
     * @param  RequestParametersComposition  $parameters
     *
     * @return LengthAwarePaginator
     * @throws QueryException
     */
    public function getData(RequestParametersComposition $parameters): LengthAwarePaginator
    {
        $mainQueryBuilder = $this->_em->createQueryBuilder();
        $mainQueryBuilder->from(Role::class, 'role')
                         ->select($mainQueryBuilder->getAllAliases())
                         ->addCriteria($parameters->buildCriteria($mainQueryBuilder->getAllAliases()));

        return $this->paginate($mainQueryBuilder->getQuery(), $parameters->getLimit(), $parameters->getPage());
    }
}