<?php


namespace Scandinaver\Blog\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\{NonUniqueResultException, NoResultException};
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Shared\BaseRepository;

/**
 * Class PostRepository
 *
 * @package Scandinaver\Blog\Infrastructure\Persistence\Doctrine
 */
class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * @return array|mixed
     */
    public function all(): array
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('p', 'c', 'cy', 'u')
            ->from($this::getEntityName(), 'p')
            ->leftJoin('p.user', 'u', 'WITH')
            ->leftJoin('p.comments', 'c',)
            ->leftJoin('p.category', 'cy', 'WITH')
            ->orderBy('p.id', 'asc')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     *
     * @return Post
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function get($id): Post
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('u', 'p')
            ->from($this::getEntityName(), 'u')
            ->join('u.plan', 'p', 'WITH')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->orderBy('p.id', 'asc')
            ->getQuery()
            ->getSingleResult();
    }
}