<?php


namespace Scandinaver\Puzzle\Infrastructure\Persistence\Doctrine;

use Scandinaver\User\Domain\User;
use Scandinaver\Shared\BaseRepository;
use Doctrine\ORM\{ORMException, OptimisticLockException};
use Scandinaver\Puzzle\Domain\{Contracts\PuzzleRepositoryInterface, Puzzle};

/**
 * Class PuzzleRepository
 * @package Scandinaver\Puzzle\Infrastructure\Persistence\Doctrine
 */
class PuzzleRepository  extends BaseRepository implements PuzzleRepositoryInterface
{
    /**
     * @param User $user
     * @return array
     */
    public function getForUser(User $user): array
    {
         $q = $this->_em->createQueryBuilder();

         return $q->select('p', 'u')
             ->from($this::getEntityName(), 'p')
             ->leftJoin('p.users', 'u', 'WITH', 'u.id = :uid')
             ->setParameter('uid', $user->getKey() )
             ->orderBy('p.id', 'asc')
             ->getQuery()
             ->getResult();
    }

    /**
     * @param User $user
     * @param Puzzle $puzzle
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addForUser(User $user, Puzzle $puzzle): void
    {
        $user->addPuzzle($puzzle);
        $this->_em->flush();
    }
}