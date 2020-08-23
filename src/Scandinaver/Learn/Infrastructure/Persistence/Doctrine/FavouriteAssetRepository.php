<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\User\Domain\Model\User;

/**
 * Class FavouriteAssetRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class FavouriteAssetRepository extends BaseRepository implements FavouriteAssetRepositoryInterface
{
    public function getFavouriteAsset(Language $language, User $user): FavouriteAsset
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
}