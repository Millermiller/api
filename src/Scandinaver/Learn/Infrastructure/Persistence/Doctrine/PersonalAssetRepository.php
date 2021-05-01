<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;

/**
 * Class PersonalAssetRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class PersonalAssetRepository extends AssetRepository implements PersonalAssetRepositoryInterface
{
    public function getAvailableAssets(Language $language, UserInterface $user): array
    {
        $q = $this->createQueryBuilder('asset');

        return $q->select('a')
                 ->from($this->getEntityName(), 'a')
                 ->join('a.passings', 'r', 'WITH')
                 ->where($q->expr()->eq('a.language', ':language'))
                 ->andWhere($q->expr()->eq('r.user', ':user'))
                 ->setParameter('language', $language)
                 ->setParameter('user', $user)
                 ->getQuery()
                 ->getResult();
    }
}