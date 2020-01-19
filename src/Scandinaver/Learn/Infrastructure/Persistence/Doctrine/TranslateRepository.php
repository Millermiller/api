<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Scandinaver\Shared\BaseRepository;
use Scandinaver\Learn\Domain\Contracts\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Translate;

/**
 * Class TranslateRepository
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class TranslateRepository  extends BaseRepository implements TranslateRepositoryInterface
{
    /**
     * @param array $ids
     * @return Translate[]
     */
    public function searchByIds(array $ids): array
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select("t, field(t.id, " . implode(", ", $ids) . ") as HIDDEN field")
            ->from($this->getEntityName(), 't')
            ->join('t.word', 'w')
            ->where('t.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->orderBy('field')
            ->getQuery()
            ->getResult();
    }
}