<?php


namespace Scandinaver\Learning\Translate\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\CountTrait;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\LevelTrait;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\Learning\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\Entity\{Text};
use Doctrine\ORM\Query\Expr;

/**
 * Class TextRepository
 *
 * @package Scandinaver\Translate\Infrastructure\Persistence\Doctrine\Repository
 */
class TextRepository extends BaseRepository implements TextRepositoryInterface
{
    use CountTrait;
    use LevelTrait;
    use PaginatesFromParams;

    public function getForUser(UserInterface $user): array
    {
        // TODO: Implement getForUser() method.
    }

    /**
     * @param  Language  $language
     *
     * @return array | Text[]
     */
    public function getByLanguage(Language $language): array
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('t')
                 ->from($this->getEntityName(), 't')
                 ->where('t.published = :published')
                 ->andWhere($q->expr()->eq('t.language', ':language'))
                 ->setParameter('published', 1)
                 ->setParameter('language', $language)
                 ->orderBy('t.level', 'asc')
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
        $mainQueryBuilder->from($this->getEntityName(), 'text')
                         ->select($mainQueryBuilder->getAllAliases())
                         ->innerJoin('text.language',  'language', Expr\Join::WITH)
                         ->addCriteria($parameters->buildCriteria($mainQueryBuilder->getAllAliases()));

        return $this->paginate($mainQueryBuilder->getQuery(), $parameters->getLimit(), $parameters->getPage());
    }
}