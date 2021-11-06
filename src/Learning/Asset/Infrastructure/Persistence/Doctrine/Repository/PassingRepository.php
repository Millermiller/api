<?php


namespace Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\{Asset, Passing};
use Scandinaver\Shared\BaseRepository;

/**
 * Class ResultRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository
 */
class PassingRepository extends BaseRepository implements PassingRepositoryInterface
{
    /**
     * @param  UserInterface   $user
     * @param  Asset  $asset
     *
     * @return Passing
     * @throws NonUniqueResultException
     */
    public function getPassing(UserInterface $user, Asset $asset): ?Passing
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
