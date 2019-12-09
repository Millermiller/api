<?php

namespace App\Repositories\Plan;

use App\Entities\Plan;
use App\Repositories\BaseRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * Class PlanRepository
 * @package App\Repositories\Plan
 */
class PlanRepository extends BaseRepository implements PlanRepositoryInterface
{
    /**
     * @param string $name
     * @return Plan
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findByName(string $name): Plan
    {
        return  $this->createQueryBuilder('plan')
            ->select('p')
            ->from($this->getEntityName(), 'p')
            ->where('p.name = :name')
            ->setParameter('name', 'Basic')
            ->getQuery()
            ->getSingleResult();
    }
}