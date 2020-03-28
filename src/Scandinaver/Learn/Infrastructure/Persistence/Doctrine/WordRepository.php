<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\{NonUniqueResultException, NoResultException};
use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Domain\Contracts\WordRepositoryInterface;
use Scandinaver\Shared\BaseRepository;

/**
 * Class WordRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
class WordRepository extends BaseRepository implements WordRepositoryInterface
{
    /**
     * @return int
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
     * @param Language $language
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
     * @param Language $language
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
}