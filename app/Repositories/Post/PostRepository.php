<?php


namespace App\Repositories\Post;

use App\Entities\{Post};
use App\Repositories\BaseRepository;
use Doctrine\ORM\{NonUniqueResultException, NoResultException};

/**
 * Class UserRepository
 * @package App\Repositories\User
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
            ->leftJoin('p.comments', 'c', )
            ->leftJoin('p.category', 'cy', 'WITH')
            ->orderBy('p.id', 'asc')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     * @return object|void|null
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function get($id)
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