<?php


namespace Scandinaver\Statistic\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\Statistic\Domain\Contract\ItemRepositoryInterface;
use Doctrine\ORM\Query\Expr;

/**
 * Class ItemRepository
 *
 * @package Scandinaver\Statistic\Infrastructure\Persistence\Doctrine\Repository
 */
class ItemRepository extends BaseRepository implements ItemRepositoryInterface
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
        $mainQueryBuilder->from($this->getEntityName(), 'statistic')
                         ->select($mainQueryBuilder->getAllAliases())
                         ->innerJoin('statistic.user',  'user', Expr\Join::WITH)
                         ->innerJoin('statistic.language',  'language', Expr\Join::WITH)
                         ->addCriteria($parameters->buildCriteria($mainQueryBuilder->getAllAliases()))
                         ->addOrderBy('statistic.createdAt', 'DESC');

        return $this->paginate($mainQueryBuilder->getQuery(), $parameters->getLimit(), $parameters->getPage());
    }
}