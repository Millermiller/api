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
}