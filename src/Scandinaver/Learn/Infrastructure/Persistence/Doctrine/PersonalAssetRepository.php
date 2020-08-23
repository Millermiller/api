<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\User\Domain\Model\User;

/**
 * Class PersonalAssetRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class PersonalAssetRepository extends BaseRepository implements PersonalAssetRepositoryInterface
{
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

    public function getAvailableAssets(Language $language, User $user): array
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
}