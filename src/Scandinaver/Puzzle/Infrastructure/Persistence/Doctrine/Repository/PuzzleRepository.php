<?php


namespace Scandinaver\Puzzle\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\{OptimisticLockException, ORMException};
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Puzzle\Domain\Contract\Repository\PuzzleRepositoryInterface;
use Scandinaver\Puzzle\Domain\Entity\Puzzle;
use Scandinaver\Shared\BaseRepository;

/**
 * Class PuzzleRepository
 *
 * @package Scandinaver\Puzzle\Infrastructure\Persistence\Doctrine\Repository
 */
class PuzzleRepository extends BaseRepository implements PuzzleRepositoryInterface
{
    public function getByLanguage(Language $language): array
    {
        $q = $this->createQueryBuilder('puzzle');

        return $q->select('puzzle')
                 ->from($this->getEntityName(), 'p')
                 ->where($q->expr()->eq('p.language', ':language'))
                 ->setParameter('language', $language)
                 ->getQuery()
                 ->getResult();
    }

    public function getForUser(Language $language, UserInterface $user): array
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('p', 'u')
                 ->from($this::getEntityName(), 'p')
                 ->leftJoin('p.users', 'u', 'WITH', 'u.id = :uid')
                 ->where($q->expr()->eq('p.language', ':language'))
                 ->setParameter('uid', $user->getKey())
                 ->setParameter('language', $language)
                 ->orderBy('p.id', 'asc')
                 ->getQuery()
                 ->getResult();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addForUser(UserInterface $user, Puzzle $puzzle): void
    {
        //$user->addPuzzle($puzzle);
       // $this->_em->flush();
    }
}