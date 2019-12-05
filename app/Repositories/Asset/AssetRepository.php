<?php


namespace App\Repositories\Asset;

use App\Entities\Asset;
use App\Entities\Language;
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
           ->andWhere('a.lang = :language')
           ->andWhere('a.type = :type')
           ->setParameter('level', 1)
           ->setParameter('type', $type)
           ->setParameter('language', $language->getName())
           ->getQuery()
           ->getSingleResult();
    }
}