<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\WordAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\BaseRepository;

/**
 * Class WordAssetRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class WordAssetRepository extends AssetRepository implements WordAssetRepositoryInterface
{
    public function getByLanguage(Language $language): array
    {
        $q = $this->createQueryBuilder('asset');

        return $q->select('a')
            ->from($this->getEntityName(), 'a')
            ->andWhere($q->expr()->eq('a.language', ':language'))
            ->setParameter('language', $language)
            ->orderBy('a.level', 'asc')
            ->getQuery()
            ->getResult();
    }

    public function getNextAsset(Asset $asset, Language $language): Asset
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('a')
            ->from($this->getEntityName(), 'a')
            ->where('a.level = :level')
            ->andWhere('a.language = :language')
            ->setParameter('level', $asset->getLevel() + 1)
            ->setParameter('language', $language)
            ->getQuery()
            ->getSingleResult();
    }

    public function getLastAsset(Language $language, int $type): Asset
    {
        $q = $this->createQueryBuilder('asset');

        return $q->select('a')
            ->from($this->getEntityName(), 'a')
            ->where('a.level = :level')
            ->andWhere($q->expr()->eq('a.language', ':language'))
            ->setParameter('level', 1)
            ->setParameter('language', $language)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getFirstAsset(Language $language, int $type): Asset
    {
        $q = $this->createQueryBuilder('asset');

        return $q->select('a')
            ->from($this->getEntityName(), 'a')
            ->where('a.level = :level')
            ->andWhere($q->expr()->eq('a.language', ':language'))
            ->setParameter('level', 1)
            ->setParameter('language', $language)
            ->getQuery()
            ->getSingleResult();
    }
}