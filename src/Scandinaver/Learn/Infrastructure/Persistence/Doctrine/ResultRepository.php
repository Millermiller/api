<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\NonUniqueResultException;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Learn\Domain\Model\{Asset, Result};
use Scandinaver\Shared\BaseRepository;
use Scandinaver\User\Domain\Model\User;

/**
 * Class ResultRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class ResultRepository extends BaseRepository implements ResultRepositoryInterface
{
    /**
     * @param  User   $user
     * @param  Asset  $asset
     *
     * @return Result
     * @throws NonUniqueResultException
     */
    public function getResult(User $user, Asset $asset): ?Result
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('r')
                 ->from($this->getEntityName(), 'r')
                 ->where($q->expr()->eq('r.user', ':user'))
                 ->andWhere($q->expr()->eq('r.asset', ':asset'))
                 ->orderBy('r.id', 'DESC')
                 ->setMaxResults(1)
                 ->setParameter('user', $user)
                 ->setParameter('asset', $asset)
                 ->getQuery()
                 ->getOneOrNullResult();
    }
}
