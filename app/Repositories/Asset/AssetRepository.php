<?php

namespace App\Repositories\Asset;

use App\Entities\{Asset, Language, User};
use App\Repositories\BaseRepository;

class AssetRepository extends BaseRepository implements AssetRepositoryInterface
{
    /**
     * @param Language $language
     * @param int $type
     * @return Asset
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getFirstAsset(Language $language, int $type) : Asset
    {
       return  $this->createQueryBuilder('asset')
           ->select('a')
           ->from($this->getEntityName(), 'a')
           ->where('a.level = :level')
           ->andWhere('a.languageId = :language_id')
           ->andWhere('a.type = :type')
           ->setParameter('level', 1)
           ->setParameter('type', $type)
           ->setParameter('language_id', $language->getId())
           ->getQuery()
           ->getSingleResult();
    }

    /**
     * @param Language $language
     * @return Asset[]
     */
    public function getPublicAssets(Language $language): array
    {
        return  $this->createQueryBuilder('asset')
            ->select('a')
            ->from($this->getEntityName(), 'a')
            ->where('a.languageId = :language_id')
            ->andWhere('a.basic = :basic')
            ->setParameter('language_id', $language->getId())
            ->setParameter('basic', 1)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param Language $language
     * @param User $user
     * @return Asset[]
     */
    public function getPersonalAssets(Language $language, User $user): array
    {
        $q =  $this->createQueryBuilder('asset');

        return $q->select('a')
            ->from($this->getEntityName(), 'a')
            ->join('a.results', 'r', 'WITH')
            ->where('a.languageId = :language_id')
            ->andWhere($q->expr()->eq('r.user', ':user'))
            ->setParameter('language_id', $language->getId())
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $type
     * @return mixed
     */
    public function getAssetsByType($language, int $type)
    {
        return  $this->createQueryBuilder('asset')
            ->select('a')
            ->from($this->getEntityName(), 'a')
            ->where('a.languageId = :language_id')
            ->andWhere('a.type = :type')
            ->setParameter('type', $type)
            ->setParameter('language_id', $language->getId())
            ->orderBy('a.level', 'asc')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param Language $language
     * @param User $user
     * @return Asset
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getFavouriteAsset(Language $language, User $user): Asset
    {
        $q =  $this->createQueryBuilder('asset');

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
     * @param Language $language
     * @param User $user
     * @return array
     */
    public function getCreatedAssets(Language $language, User $user) : array
    {
        $q =  $this->createQueryBuilder('asset');

        return $q->select('a')
            ->from($this->getEntityName(), 'a')
            ->join('a.results', 'r', 'WITH')
         //   ->join('a.cards', 'c', 'WITH')
            ->where('a.languageId = :language_id')
            ->andWhere($q->expr()->eq('r.user', ':user'))
            ->andWhere('a.basic = :basic')
            ->setParameter('language_id', $language->getId())
            ->setParameter('user', $user)
            ->setParameter('basic', 0)
            ->getQuery()
            ->getResult();
    }
}