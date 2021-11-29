<?php


namespace Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository;

use Scandinaver\Learning\Asset\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Translate;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;

/**
 * Class TranslateRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository
 */
class TranslateRepository extends BaseRepository implements TranslateRepositoryInterface
{
    /**
     * @return Translate[]
     */
    public function searchByIds(array $ids): array
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select(
            "t, field(t.id, ".implode(", ", $ids).") as HIDDEN field"
        )
                 ->from($this->getEntityName(), 't')
                 ->join('t.term', 'w')
                 ->where('t.id IN (:ids)')
                 ->setParameter('ids', $ids)
                 ->orderBy('field')
                 ->getQuery()
                 ->getResult();
    }
}