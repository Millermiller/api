<?php

namespace App\Repositories\Result;

use App\Entities\{Asset, Result, User, Language};
use App\Repositories\BaseRepository;
use Doctrine\ORM\AbstractQuery;

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
            ->getResult(AbstractQuery::HYDRATE_ARRAY);
    }

    /**
     * @param User $user
     * @param Asset $asset
     * @return Result
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getResult(User $user, Asset $asset): Result
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('r.assetId')
            ->from($this->getEntityName(), 'r')
            ->where($q->expr()->eq('r.user', ':user'))
            ->andWhere($q->expr()->eq('r.asset', ':asset'))
            ->setParameter('user', $user)
            ->setParameter('asset', $asset)
            ->getQuery()
            ->getSingleResult();
    }
}
