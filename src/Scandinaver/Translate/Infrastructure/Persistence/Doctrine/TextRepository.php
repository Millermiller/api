<?php


namespace Scandinaver\Translate\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\{NonUniqueResultException, NoResultException};
use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\Translate\Domain\{Result, Text};
use Scandinaver\Translate\Domain\Contracts\TextRepositoryInterface;
use Scandinaver\User\Domain\User;

/**
 * Class TextRepository
 *
 * @package Scandinaver\Translate\Infrastructure\Persistence\Doctrine
 */
class TextRepository extends BaseRepository implements TextRepositoryInterface
{
    /**
     * @param Language $language
     *
     * @return Text
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getFirstText(Language $language): Text
    {
        return $this->createQueryBuilder('asset')
                    ->select('a')
                    ->from($this->getEntityName(), 'a')
                    ->where('a.level = :level')
                    ->andWhere('a.languageId = :language')
                    ->setParameter('level', 1)
                    ->setParameter('language', $language->getId())
                    ->getQuery()
                    ->getSingleResult();
    }

    /**
     * @param User     $user
     * @param Language $language
     *
     * @return array
     */
    public function getActiveIds(User $user, Language $language): array
    {
        $q = $this->_em->createQueryBuilder();

        app('em')->getConfiguration()->addCustomHydrationMode('ColumnHydrator', 'Scandinaver\Common\Infrastructure\Persistence\Doctrine\ColumnHydrator');

        return $q->select('r.textId')
                 ->from(Result::class, 'r')
                 ->join('r.text', 't')
                 ->where($q->expr()->eq('r.user', ':user'))
                 ->andWhere($q->expr()->eq('t.language', ':language'))
                 ->setParameter('user', $user)
                 ->setParameter('language', $language)
                 ->getQuery()
                 ->getResult('ColumnHydrator');
    }


    /**
     * @inheritDoc
     */
    public function getForUser(User $user): array
    {
        // TODO: Implement getForUser() method.
    }

    /**
     * @param Language $language
     *
     * @return array | Text[]
     */
    public function getByLanguage(Language $language): array
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('t')
                 ->from(Text::class, 't')
                 ->where('t.published = :published')
                 ->andWhere($q->expr()->eq('t.language', ':language'))
                 ->setParameter('published', 1)
                 ->setParameter('language', $language)
                 ->orderBy('t.level', 'asc')
                 ->getQuery()
                 ->getResult();
    }


    /**
     * @param Text     $text
     * @param Language $language
     *
     * @return Text
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getNextText(Text $text, Language $language): Text
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('t')
                 ->from($this->getEntityName(), 't')
                 ->where('a.level = :level')
                 ->andWhere('a.language = :language')
                 ->setParameter('level', $text->getLevel() + 1)
                 ->setParameter('language', $language)
                 ->getQuery()
                 ->getSingleResult();
    }

    /**TODO: повторяется
     *
     * @param Language $language
     *
     * @return int
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getCountByLanguage(Language $language): int
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('count(t.id)')
                 ->from($this->getEntityName(), 't')
                 ->where($q->expr()->eq('t.language', ':language'))
                 ->setParameter('language', $language)
                 ->getQuery()
                 ->getSingleScalarResult();
    }
}