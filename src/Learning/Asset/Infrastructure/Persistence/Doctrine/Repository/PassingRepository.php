<?php


namespace Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\{Asset, Passing};
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;
use Doctrine\ORM\Query\Expr;

/**
 * Class ResultRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository
 */
class PassingRepository extends BaseRepository implements PassingRepositoryInterface, FilterableRepositoryInterface
{
    use PaginatesFromParams;

    /**
     * @param  UserInterface   $user
     * @param  Asset  $asset
     *
     * @return Passing
     * @throws NonUniqueResultException
     */
    public function getPassing(UserInterface $user, Asset $asset): ?Passing
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('r')
                 ->from($this->getEntityName(), 'r')
                 ->where($q->expr()->eq('r.user', ':user'))
                 ->andWhere($q->expr()->eq('r.asset', ':asset'))
                 ->orderBy('r.id', 'DESC')
                 ->setMaxResults(1)
                 ->setParameter('user', $user)
                 ->setParameter('asset', $asset)
                 ->getQuery()
                 ->getOneOrNullResult();
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
        $mainQueryBuilder->from($this->getEntityName(), 'passing')
                         ->select($mainQueryBuilder->getAllAliases())
                         ->innerJoin('passing.user',  'user', Expr\Join::WITH)
                         ->innerJoin('passing.subject',  'asset', Expr\Join::WITH)
                         ->innerJoin('asset.language',  'language', Expr\Join::WITH)
                         ->addCriteria($parameters->buildCriteria($mainQueryBuilder->getAllAliases()));

        return $this->paginate($mainQueryBuilder->getQuery(), $parameters->getLimit(), $parameters->getPage());
    }
}
