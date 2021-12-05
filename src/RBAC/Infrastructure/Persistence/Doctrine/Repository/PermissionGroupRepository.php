<?php


namespace Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\RBAC\Domain\Contract\Repository\PermissionGroupRepositoryInterface;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;
use Scandinaver\RBAC\Domain\Entity\PermissionGroup;

/**
 * Class PermissionGroupRepository
 *
 * @package Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\Repository
 */
class PermissionGroupRepository extends BaseRepository implements PermissionGroupRepositoryInterface
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
        $mainQueryBuilder->from(PermissionGroup::class, 'permissionGroup')
                         ->select($mainQueryBuilder->getAllAliases())
                         ->addCriteria($parameters->buildCriteria($mainQueryBuilder->getAllAliases()));

        return $this->paginate($mainQueryBuilder->getQuery(), $parameters->getLimit(), $parameters->getPage());
    }
}