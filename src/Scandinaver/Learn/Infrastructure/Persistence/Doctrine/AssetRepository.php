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
}