<?php


namespace Scandinaver\User\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Doctrine\ORM\Query\Expr;
use Scandinaver\User\Domain\Entity\User;

/**
 * Class UserRepository
 *
 * @package Scandinaver\User\Infrastructure\Persistence\Doctrine\Repository
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface, FilterableRepositoryInterface
{
    use PaginatesFromParams;

    /**
     * @param $string
     *
     * @return array
     */
    public function findByNameOrEmail($string): array
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('u', 'p')
                 ->from($this::getEntityName(), 'u')
                 ->join('u.plan', 'p', 'WITH')
                 ->where('u.login = :login')
                 ->orWhere('u.email = :email')
                 ->orderBy('u.id', 'desc')
                 ->setParameter('login', $string)
                 ->setParameter('email', $string)
                 ->getQuery()
                 ->getResult();
    }

    /**
     * @param  RequestParametersComposition  $parameters
     *
     * @return LengthAwarePaginator
     * @throws QueryException
     */
    public function getData(RequestParametersComposition $parameters): LengthAwarePaginator
    {
        $mainQueryBuilder = $this->_em->createQueryBuilder();
        $mainQueryBuilder->from(User::class, 'user')
                         ->select($mainQueryBuilder->getAllAliases())
                         ->leftJoin('user.permissions',  'permissions', Expr\Join::WITH)
                         ->leftJoin('user.roles',  'roles', Expr\Join::WITH)
                         ->addCriteria($parameters->buildCriteria($mainQueryBuilder->getAllAliases()));

        return $this->paginate($mainQueryBuilder->getQuery(), $parameters->getLimit(), $parameters->getPage());
    }
}