<?php


namespace Scandinaver\User\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\{NoResultException, NonUniqueResultException};
use Scandinaver\Shared\BaseRepository;
use Scandinaver\User\Domain\Plan;
use Scandinaver\User\Domain\Contracts\PlanRepositoryInterface;

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