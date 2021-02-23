<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\User\Domain\Model\User;

/**
 * Class PersonalAssetRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class PersonalAssetRepository extends BaseRepository implements PersonalAssetRepositoryInterface
{
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