<?php


namespace Scandinaver\Translate\Infrastructure\Persistence\Doctrine\Repository;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\Repository\CountTrait;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\Repository\LevelTrait;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Translate\Domain\Entity\{Text};

/**
 * Class TextRepository
 *
 * @package Scandinaver\Translate\Infrastructure\Persistence\Doctrine\Repository
 */
class TextRepository extends BaseRepository implements TextRepositoryInterface
{
    use CountTrait;
    use LevelTrait;

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
}