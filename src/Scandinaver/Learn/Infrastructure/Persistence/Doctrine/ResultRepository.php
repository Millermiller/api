<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Scandinaver\Learn\Domain\{Asset, Result};
use App\Entities\{User, Language};
use App\Repositories\BaseRepository;
use Scandinaver\Learn\Domain\Contracts\ResultRepositoryInterface;

/**
 * Class ResultRepository
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class ResultRepository extends BaseRepository implements ResultRepositoryInterface
{
    /**
     * @param User $user
     * @param Language $language
     * @return array
     */
    public function getActiveIds(User $user, Language $language): array
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

        return $q->select('r')
            ->from($this->getEntityName(), 'r')
            ->where($q->expr()->eq('r.user', ':user'))
            ->andWhere($q->expr()->eq('r.asset', ':asset'))
            ->setParameter('user', $user)
            ->setParameter('asset', $asset)
            ->getQuery()
            ->getSingleResult();
    }
}
