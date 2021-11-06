<?php


namespace Scandinaver\User\Infrastructure\Persistence\Doctrine\Repository;

use Scandinaver\Shared\BaseRepository;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;

/**
 * Class UserRepository
 *
 * @package Scandinaver\User\Infrastructure\Persistence\Doctrine\Repository
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @param $string
     *
     * @return array
     */
    public function findByNameOrEmail($string): array
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('u', 'p')
                 ->from($this::getEntityName(), 'u')
                 ->join('u.plan', 'p', 'WITH')
                 ->where('u.login = :login')
                 ->orWhere('u.email = :email')
                 ->orderBy('u.id', 'desc')
                 ->setParameter('login', $string)
                 ->setParameter('email', $string)
                 ->getQuery()
                 ->getResult();
    }
}