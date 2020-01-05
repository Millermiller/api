<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use App\Repositories\BaseRepository;
use Doctrine\ORM\{NonUniqueResultException, NoResultException};
use Scandinaver\Learn\Domain\Contracts\WordRepositoryInterface;

/**
 * Class WordRepository
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class WordRepository extends BaseRepository implements WordRepositoryInterface
{
    /**
     * @return int
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countAudio(): int
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('count(w.id)')
            ->from($this->getEntityName(), 'w')
            ->where($q->expr()->isNotNull('w.audio'))
            ->getQuery()
            ->getSingleScalarResult();
    }
}