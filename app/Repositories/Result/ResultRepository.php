<?php


namespace App\Repositories\Result;

use App\Entities\User;
use App\Entities\Language;
use App\Repositories\BaseRepository;

class ResultRepository extends BaseRepository implements ResultRepositoryInterface
{
    /**
     * @param User $user
     * @param Language $language
     * @return array
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function getActiveIds(User $user, Language $language) : array
    {
        $q = $this->_em->createQueryBuilder();

        app('em')->getConfiguration()->addCustomHydrationMode('ColumnHydrator', '\App\Hydrators\ColumnHydrator');

        return $q->select('r.assetId')
            ->from($this->getEntityName(), 'r')
            ->join('r.asset', 'a')
            ->where($q->expr()->eq('r.user', ':user'))
            ->andWhere($q->expr()->eq('a.language', ':language'))
            ->setParameter('user', $user)
            ->setParameter('language', $language)
            ->getQuery()
            ->getResult('ColumnHydrator');
    }
}
