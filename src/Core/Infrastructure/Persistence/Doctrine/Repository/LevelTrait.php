<?php


namespace Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use Scandinaver\Core\Domain\Contract\LearnItemInterface;
use Scandinaver\Common\Domain\Entity\Language;

/**
 * Trait LevelTrait
 *
 * @package Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository
 */
trait LevelTrait
{

    /**
     * @param  Language  $language
     *
     * @return LearnItemInterface
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getFirstLevel(Language $language): LearnItemInterface
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->createQueryBuilder('asset');

        return $queryBuilder->select('a')
                 ->from($this->getEntityName(), 'a')
                 ->where('a.level = :level')
                 ->andWhere($queryBuilder->expr()->eq('a.language', ':language'))
                 ->setParameter('level', 1)
                 ->setParameter('language', $language->getId())
                 ->getQuery()
                 ->getSingleResult();
    }

    /**
     * @param  Language  $language
     *
     * @return LearnItemInterface
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getLastLevel(Language $language): LearnItemInterface
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->createQueryBuilder('asset');

        return $queryBuilder->select('a')
                 ->from($this->getEntityName(), 'a')
                 ->where($queryBuilder->expr()->eq('a.language', ':language'))
                 ->setParameter('language', $language)
                 ->orderBy('a.level', 'DESC')
                 ->setMaxResults(1)
                 ->getQuery()
                 ->getSingleResult();
    }


    /**
     * @param  LearnItemInterface  $entity
     *
     * @return LearnItemInterface|null
     * @throws NonUniqueResultException
     */
    public function getNextLevel(LearnItemInterface $entity): ?LearnItemInterface
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->createQueryBuilder('asset');

        return $queryBuilder->select('a')
                 ->from($this->getEntityName(), 'a')
                 ->where('a.level = :level')
                 ->andWhere('a.language = :language')
                 ->setParameter('level', $entity->getLevel() + 1)
                 ->setParameter('language', $entity->getLanguage())
                 ->getQuery()
                 ->getOneOrNullResult();
    }
}