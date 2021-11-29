<?php


namespace Scandinaver\Common\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\Domain\Entity\Log;
use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\User\Domain\Entity\User;
use Doctrine\ORM\Query\Expr;

/**
 * Class LogRepository
 *
 * @package Scandinaver\Common\Infrastructure\Persistence\Doctrine\Repository
 */
class LogRepository extends BaseRepository implements LogRepositoryInterface, FilterableRepositoryInterface
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
        $mainQueryBuilder->from(Log::class, 'log')
                         ->select($mainQueryBuilder->getAllAliases())
                         ->leftJoin(User::class, 'owner', Expr\Join::WITH, 'owner.id = log.owner')
                         ->addCriteria($parameters->buildCriteria($mainQueryBuilder->getAllAliases()));

        return $this->paginate($mainQueryBuilder->getQuery(), $parameters->getLimit(), $parameters->getPage());
    }
}