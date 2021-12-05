<?php


namespace Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\RBAC\Domain\Contract\Repository\PermissionRepositoryInterface;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Doctrine\ORM\Query\Expr;
use Scandinaver\RBAC\Domain\Entity\PermissionGroup;

/**
 * Class PermissionRepository
 *
 * @package Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\Repository
 */
class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
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
        $mainQueryBuilder->from(Permission::class, 'permission')
                         ->select($mainQueryBuilder->getAllAliases())
                         ->leftJoin(PermissionGroup::class, 'g', Expr\Join::WITH, 'g.id = permission.group')
                         ->addCriteria($parameters->buildCriteria($mainQueryBuilder->getAllAliases()));

        return $this->paginate($mainQueryBuilder->getQuery(), $parameters->getLimit(), $parameters->getPage());
    }
}