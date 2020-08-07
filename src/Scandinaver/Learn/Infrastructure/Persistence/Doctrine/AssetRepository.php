<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AssetRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class AssetRepository extends BaseRepository implements AssetRepositoryInterface
{
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
            ->andWhere($q->expr()->eq('a.language', ':language'))
            ->andWhere('a.type = :type')
            ->setParameter('level', 1)
            ->setParameter('type', $type)
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
            ->andWhere('a.type = :type')
            ->setParameter('level', 1)
            ->setParameter('type', $type)
            ->setParameter('language', $language)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @param  Language  $language
     *
     * @return Asset[]
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
     * @param  User      $user
     *
     * @return Asset[]
     */
    public function getPersonalAssets(Language $language, User $user): array
    {
        $q = $this->createQueryBuilder('asset');

        return $q->select('a')
            ->from($this->getEntityName(), 'a')
            ->join('a.results', 'r', 'WITH')
            ->where($q->expr()->eq('a.language', ':language'))
            ->andWhere($q->expr()->eq('r.user', ':user'))
            ->setParameter('language', $language)
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param  int  $type
     *
     * @return mixed
     */
    public function getAssetsByType($language, int $type): array
    {
        $q = $this->createQueryBuilder('asset');

        return $q->select('a')
            ->from($this->getEntityName(), 'a')
            ->andWhere($q->expr()->eq('a.language', ':language'))
            ->andWhere('a.type = :type')
            ->setParameter('type', $type)
            ->setParameter('language', $language)
            ->orderBy('a.level', 'asc')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param  Language  $language
     * @param  User      $user
     *
     * @return Asset
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getFavouriteAsset(Language $language, User $user): Asset
    {
        $q = $this->createQueryBuilder('asset');

        return $q->select('a', 'r')
            ->from($this->getEntityName(), 'a')
            ->join('a.results', 'r', 'WITH')
            ->where($q->expr()->eq('a.language', ':language'))
            ->andWhere($q->expr()->eq('r.user', ':user'))
            ->andWhere('a.favorite = :favorite')
            ->setParameter('language', $language)
            ->setParameter('user', $user)
            ->setParameter('favorite', 1)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @param  Language  $language
     * @param  User      $user
     *
     * @return array
     */
    public function getCreatedAssets(Language $language, User $user): array
    {
        $q = $this->createQueryBuilder('asset');

        return $q->select('a')
            ->from($this->getEntityName(), 'a')
            ->join('a.results', 'r', 'WITH')
            //   ->join('a.cards', 'c', 'WITH')
            ->where($q->expr()->eq('a.language', ':language'))
            ->andWhere($q->expr()->eq('r.user', ':user'))
            ->andWhere('a.basic = :basic')
            ->setParameter('language', $language)
            ->setParameter('user', $user)
            ->setParameter('basic', 0)
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
    public function getNextAsset(Asset $asset, Language $language): Asset
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('a')
            ->from($this->getEntityName(), 'a')
            ->where('a.level = :level')
            ->andWhere('a.type = :type')
            ->andWhere('a.language = :language')
            ->setParameter('level', $asset->getLevel() + 1)
            ->setParameter('type', $asset->getType())
            ->setParameter('language', $language)
            ->getQuery()
            ->getSingleResult();
    }

    /**TODO: повторяется
     *
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
}