<?php


namespace Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\Repository\CountTrait;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\Repository\LevelTrait;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;
use Scandinaver\Shared\BaseRepository;

/**
 * Class AssetRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository
 */
class AssetRepository extends BaseRepository implements AssetRepositoryInterface
{
    use CountTrait;
    use LevelTrait;

    /**
     * @param  Language  $language
     *
     * @return array
     */
    public function getPublicAssets(Language $language): array
    {
        $this->_em->createQuery();

        $query = $this->getEntityManager()->createQuery('
        SELECT a FROM Scandinaver\Learning\Asset\Domain\Entity\Asset a
        WHERE (
                a INSTANCE OF Scandinaver\Learning\Asset\Domain\Entity\WordAsset
                    OR 
                a INSTANCE OF Scandinaver\Learning\Asset\Domain\Entity\SentenceAsset
        )
        AND a.language = :languageId'
        )->setParameter('languageId', $language->getId());

        return $query->getResult();
    }

    /**
     * @param  Language  $language
     *
     * @return array<Asset>
     */
    public function getByLanguage(Language $language): array
    {
        $q = $this->createQueryBuilder('asset');

        return $q->select('a')
                 ->from($this->getEntityName(), 'a')
                 ->where($q->expr()->eq('a.language', ':language'))
                 ->setParameter('language', $language)
                 ->orderBy('a.level', 'ASC')
                 ->getQuery()
                 ->getResult();
    }
}