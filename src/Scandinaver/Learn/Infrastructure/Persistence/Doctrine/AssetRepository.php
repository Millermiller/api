<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\BaseRepository;

/**
 * Class AssetRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class AssetRepository extends BaseRepository implements AssetRepositoryInterface
{
    /**
     * @param  Language  $language
     *
     * @return array
     */
    public function getPublicAssets(Language $language): array
    {
        $q = $this->createQueryBuilder('asset');

        return $this->createQueryBuilder('asset')
                    ->select('a')
                    ->from($this->getEntityName(), 'a')
                    ->where($q->expr()->eq('a.language', ':language'))
                    ->andWhere('a.basic = :basic')
                    ->setParameter('language', $language)
                    ->setParameter('basic', 1)
                    ->getQuery()
                    ->getResult();
    }

    /**
     * @param  Language  $language
     *
     * @return int
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getCountByLanguage(Language $language): int
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('count(a.id)')
                 ->from($this->getEntityName(), 'a')
                 ->where($q->expr()->eq('a.language', ':language'))
                 ->setParameter('language', $language)
                 ->getQuery()
                 ->getSingleScalarResult();
    }

    /**
     * @param  Language  $language
     *
     * @return array
     */
    public function getByLanguage(Language $language): array
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
     * @param  Language  $language
     * @param  int       $type
     *
     * @return Asset
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getFirstAsset(Language $language, int $type): Asset
    {
        $q = $this->createQueryBuilder('asset');

        return $q->select('a')
                 ->from($this->getEntityName(), 'a')
                 ->where('a.level = :level')
                 ->andWhere('a.category = :type')
                 ->andWhere($q->expr()->eq('a.language', ':language'))
                 ->setParameter('level', 1)
                 ->setParameter('language', $language)
                 ->setParameter('type', $type)
                 ->getQuery()
                 ->getSingleResult();
    }
}