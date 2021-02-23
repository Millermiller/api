<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\{NonUniqueResultException, NoResultException};
use Doctrine\ORM\Query\Expr\Join;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Shared\BaseRepository;

/**
 * Class WordRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class WordRepository extends BaseRepository implements WordRepositoryInterface
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