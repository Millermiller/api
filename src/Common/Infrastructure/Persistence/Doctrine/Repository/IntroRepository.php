<?php


namespace Scandinaver\Common\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Scandinaver\Common\Domain\Contract\Repository\IntroRepositoryInterface;
use Scandinaver\Common\Domain\Entity\Intro;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;

/**
 * Class IntroRepository
 *
 * @package Scandinaver\Common\Infrastructure\Persistence\Doctrine\Repository
 */
class IntroRepository extends BaseRepository implements IntroRepositoryInterface
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
        $mainQueryBuilder->from(Intro::class, 'intro')
                         ->select($mainQueryBuilder->getAllAliases())
                         ->addCriteria($parameters->buildCriteria($mainQueryBuilder->getAllAliases()));

        return $this->paginate($mainQueryBuilder->getQuery(), $parameters->getLimit(), $parameters->getPage());
    }
}