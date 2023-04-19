<?php


namespace Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\CountTrait;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\LevelTrait;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;
use Doctrine\ORM\Query\Expr;

/**
 * Class AssetRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository
 */
class AssetRepository extends BaseRepository implements AssetRepositoryInterface
{
    use CountTrait;
    use LevelTrait;
    use PaginatesFromParams;

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

    /**
     * @param  RequestParametersComposition  $parameters
     *
     * @return LengthAwarePaginator
     * @throws QueryException
     */
    public function getData(RequestParametersComposition $parameters): LengthAwarePaginator
    {
        $mainQueryBuilder = $this->_em->createQueryBuilder();
        $mainQueryBuilder->from($this->getEntityName(), 'asset')
                         ->select($mainQueryBuilder->getAllAliases())
                         ->innerJoin('asset.language',  'language', Expr\Join::WITH)
                         ->addCriteria($parameters->buildCriteria($mainQueryBuilder->getAllAliases()))
                         ->addOrderBy('asset.createdAt', 'DESC');

        return $this->paginate($mainQueryBuilder->getQuery(), $parameters->getLimit(), $parameters->getPage());
    }
}