<?php

namespace App\Repositories\Translate;

use App\Entities\Translate;
use App\Repositories\BaseRepository;

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