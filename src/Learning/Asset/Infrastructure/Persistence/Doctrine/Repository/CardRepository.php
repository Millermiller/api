<?php


namespace Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;
use Doctrine\ORM\Query\Expr;

/**
 * Class CardRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository
 */
class CardRepository extends BaseRepository implements CardRepositoryInterface
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
        $mainQueryBuilder->from($this->getEntityName(), 'card')
                         ->select($mainQueryBuilder->getAllAliases())
                         ->innerJoin('card.term',  'term', Expr\Join::WITH)
                         ->innerJoin('card.translate',  'translate', Expr\Join::WITH)
                         ->innerJoin('card.language',  'language', Expr\Join::WITH)
                         ->addCriteria($parameters->buildCriteria($mainQueryBuilder->getAllAliases()));

        return $this->paginate($mainQueryBuilder->getQuery(), $parameters->getLimit(), $parameters->getPage());
    }
}