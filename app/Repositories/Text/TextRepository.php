<?php

namespace App\Repositories\Text;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use App\Entities\{Text, Language, TextsUsers, User};
use App\Repositories\BaseRepository;
use Doctrine\ORM\AbstractQuery;

class TextRepository extends BaseRepository implements TextRepositoryInterface
{
    /**
     * @param Language $language
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
     * @param User $user
     * @param Language $language
     * @return array
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function getActiveIds(User $user, Language $language): array
    {
        $q = $this->_em->createQueryBuilder();

        app('em')->getConfiguration()->addCustomHydrationMode('ColumnHydrator', '\App\Hydrators\ColumnHydrator');

        return $q->select('r.textId')
            ->from(TextsUsers::class, 'r')
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
     * @param Text $text
     * @param Language $language
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
}