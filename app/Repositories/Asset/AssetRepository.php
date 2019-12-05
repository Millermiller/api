<?php


namespace App\Repositories\Asset;

use App\Entities\Asset;
use App\Entities\Language;
use App\Entities\User;
use App\Repositories\BaseRepository;
use Doctrine\Common\Collections\Collection;

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
}