<?php


namespace Scandinaver\Common\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\{NonUniqueResultException, NoResultException};
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\BaseRepository;

/**
 * Class LanguageRepository
 *
 * @package Scandinaver\Common\Infrastructure\Persistence\Doctrine
 */
class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    /**
     * @param  string  $letter
     *
     * @return Language
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getByName(string $letter): Language
    {
        return $this->createQueryBuilder('language')
                    ->select('l')
                    ->from($this->getEntityName(), 'l')
                    ->where('l.letter = :letter')
                    ->setParameter('letter', $letter)
                    ->getQuery()
                    ->getSingleResult();
    }
}