<?php

namespace App\Repositories\Plan;

use App\Entities\Plan;
use App\Repositories\BaseRepository;

class PlanRepository extends BaseRepository implements PlanRepositoryInterface
{
    /**
     * @param string $name
     * @return Plan
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
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