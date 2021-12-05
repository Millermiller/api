<?php


namespace Scandinaver\Blog\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Scandinaver\Blog\Domain\Contract\Repository\CommentRepositoryInterface;
use Scandinaver\Blog\Domain\Entity\Comment;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;

/**
 * Class CommentRepository
 *
 * @package Scandinaver\Blog\Infrastructure\Persistence\Doctrine\Repository
 */
class CommentRepository extends BaseRepository implements CommentRepositoryInterface
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
        $mainQueryBuilder->from(Comment::class, 'comment')
                         ->select($mainQueryBuilder->getAllAliases())
                         ->addCriteria($parameters->buildCriteria($mainQueryBuilder->getAllAliases()));

        return $this->paginate($mainQueryBuilder->getQuery(), $parameters->getLimit(), $parameters->getPage());
    }
}