<?php


namespace Scandinaver\User\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\{NonUniqueResultException, NoResultException};
use Scandinaver\Shared\BaseRepository;
use Scandinaver\User\Domain\Contract\Repository\PlanRepositoryInterface;
use Scandinaver\User\Domain\Model\Plan;

/**
 * Class PlanRepository
 *
 * @package Scandinaver\User\Infrastructure\Persistence\Doctrine
 */
class PlanRepository extends BaseRepository implements PlanRepositoryInterface
{
    /**
     * @param  string  $name
     *
     * @return Plan
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findByName(string $name): Plan
    {
        return $this->createQueryBuilder('plan')
            ->select('p')
            ->from($this->getEntityName(), 'p')
            ->where('p.name = :name')
            ->setParameter('name', 'Basic')
            ->getQuery()
            ->getSingleResult();
    }
}