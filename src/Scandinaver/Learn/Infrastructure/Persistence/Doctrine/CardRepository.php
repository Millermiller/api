<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\Translate\Domain\Model\Text;
use Scandinaver\User\Domain\Model\User;

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
     * @param  Language  $language
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

    public function getSentences(Language $language): array
    {

    }
}