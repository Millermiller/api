<?php


namespace Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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
        $queryBuilder = $this->createQueryBuilder('asset');

        return $queryBuilder->select('a')
                 ->from($this->getEntityName(), 'a')
                 ->where($queryBuilder->expr()->eq('a.language', ':language'))
                 ->setParameter('language', $language->getId())
                 ->orderBy('a.level', 'ASC')
                 ->setMaxResults(1)
                 ->getQuery()
                 ->getSingleResult();
    }

    /**
     * @param  Language  $language
     *
     * @return LearnItemInterface|null
     * @throws NonUniqueResultException
     */
    public function getLastLevel(Language $language): ?LearnItemInterface
    {
        $queryBuilder = $this->createQueryBuilder('asset');

        return $queryBuilder->select('a')
                 ->from($this->getEntityName(), 'a')
                 ->where($queryBuilder->expr()->eq('a.language', ':language'))
                 ->setParameter('language', $language)
                 ->orderBy('a.level', 'DESC')
                 ->setMaxResults(1)
                 ->getQuery()
                 ->getOneOrNullResult();
    }


    /**
     * @param  LearnItemInterface  $entity
     * // TODO: may work incorrect @see \Tests\Unit\Repositories\Asset\AssetRepositoryTest::testGetNextAsset
     * @return LearnItemInterface|null
     * @throws NonUniqueResultException
     */
    public function getNextLevel(LearnItemInterface $entity): ?LearnItemInterface
    {

        $queryBuilder = $this->_em->createQueryBuilder();

        return $queryBuilder->select('asset')
                 ->from($this->getEntityName(), 'asset')
                 ->where('asset.level = :level')
                 ->andWhere($queryBuilder->expr()->eq('asset.language', ':language'))
                 ->setParameter('level', $entity->getLevel() + 1)
                 ->setParameter('language', $entity->getLanguage())
                 ->getQuery()
                 ->getOneOrNullResult();
    }
}