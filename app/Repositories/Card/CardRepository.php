<?php

namespace App\Repositories\Card;

use App\Entities\{Text, Language, User};
use App\Repositories\BaseRepository;

class CardRepository extends BaseRepository implements CardRepositoryInterface
{
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
    public function getByLanguage(Language $language) : array
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
}