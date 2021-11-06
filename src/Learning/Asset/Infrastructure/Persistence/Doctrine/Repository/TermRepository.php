<?php


namespace Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\{NonUniqueResultException, NoResultException};
use Doctrine\ORM\Query\Expr\Join;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Shared\BaseRepository;

/**
 * Class TermRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository
 */
class TermRepository extends BaseRepository implements TermRepositoryInterface
{
    /**
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countAudio(): int
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('count(w.id)')
                 ->from($this->getEntityName(), 'w')
                 ->where($q->expr()->isNotNull('w.audio'))
                 ->getQuery()
                 ->getSingleScalarResult();
    }

    /**
     * @param  Language  $language
     *
     * @return int
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getCountByLanguage(Language $language): int
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('count(w.id)')
                 ->from($this->getEntityName(), 'w')
                 ->where($q->expr()->eq('w.language', ':language'))
                 ->setParameter('language', $language)
                 ->getQuery()
                 ->getSingleScalarResult();
    }

    /**
     * @param  Language  $language
     *
     * @return int
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getCountAudioByLanguage(Language $language): int
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('count(w.id)')
                 ->from($this->getEntityName(), 'w')
                 ->where($q->expr()->eq('w.language', ':language'))
                 ->where($q->expr()->isNotNull('w.audio'))
                 ->setParameter('language', $language)
                 ->getQuery()
                 ->getSingleScalarResult();
    }

    /**
     * @param  Language  $language
     *
     * @return array
     */
    public function getUntranslated(Language $language): array
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('w', 't')
                 ->from($this->getEntityName(), 'w')
                 ->leftJoin('w.translates', 't', Join::WITH, $q->expr()->eq('t.language', ':language'))
                 ->where($q->expr()->isNull('t.id'))
                 ->setParameter('language', $language)
                 ->getQuery()
                 ->getResult();
    }
}