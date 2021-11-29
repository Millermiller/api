<?php


namespace Scandinaver\Learning\Puzzle\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\{OptimisticLockException, ORMException};
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Puzzle\Domain\Contract\Repository\PuzzleRepositoryInterface;
use Scandinaver\Learning\Puzzle\Domain\Entity\Puzzle;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;

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

    public function addForUser(UserInterface $user, Puzzle $puzzle): void
    {
        //$user->addPuzzle($puzzle);
       // $this->_em->flush();
    }
}