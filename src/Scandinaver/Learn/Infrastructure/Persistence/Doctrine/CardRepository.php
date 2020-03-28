<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Domain\Contracts\CardRepositoryInterface;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\Text\Domain\Text;
use Scandinaver\User\Domain\User;

/**
 * Class CardRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine
 */
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
}