<?php


namespace Scandinaver\User\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\{NonUniqueResultException, NoResultException};
use Scandinaver\Shared\BaseRepository;
use Scandinaver\User\Domain\Contract\Repository\PlanRepositoryInterface;
use Scandinaver\User\Domain\Entity\Plan;

/**
 * Class PlanRepository
 *
 * @package Scandinaver\User\Infrastructure\Persistence\Doctrine\Repository
 */
class PlanRepository extends BaseRepository implements PlanRepositoryInterface
{
    /**
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