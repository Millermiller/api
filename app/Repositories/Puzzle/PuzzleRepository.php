<?php

namespace App\Repositories\Puzzle;

use App\Entities\User;
use App\Repositories\BaseRepository;

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
}