<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learn\Domain\Contract\Repository\SentenceAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Entity\Asset;

/**
 * Class SentenceAssetRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository
 */
class SentenceAssetRepository extends AssetRepository implements SentenceAssetRepositoryInterface
{

    /**
     * @param  Language  $language
     *
     * @return array
     */
    public function getByLanguage($language): array
    {
        $q = $this->createQueryBuilder('asset');

        return $q->select('a')
                 ->from($this->getEntityName(), 'a')
                 ->where($q->expr()->eq('a.language', ':language'))
                 ->setParameter('language', $language)
                 ->orderBy('a.level', 'asc')
                 ->getQuery()
                 ->getResult();
    }

    /**
     * @param  Asset  $asset
     *
     * @return Asset
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getNextAsset(Asset $asset): Asset
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('a')
                 ->from($this->getEntityName(), 'a')
                 ->where('a.level = :level')
                 ->andWhere('a.language = :language')
                 ->setParameter('level', $asset->getLevel() + 1)
                 ->setParameter('language', $asset->getLanguage())
                 ->getQuery()
                 ->getSingleResult();
    }

    /**
     * @param  Language  $language
     * @param  int       $type
     *
     * @return Asset|null
     * @throws NonUniqueResultException
     */
    public function getLastAsset(Language $language, int $type): ?Asset
    {
        $q = $this->createQueryBuilder('asset');

        return $q->select('a')
                 ->from($this->getEntityName(), 'a')
                 ->where($q->expr()->eq('a.language', ':language'))
                 ->setParameter('language', $language)
                 ->orderBy('a.level', 'DESC')
                 ->setMaxResults(1)
                 ->getQuery()
                 ->getOneOrNullResult();
    }

}