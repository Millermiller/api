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
     * @param  string  $name
     *
     * @return Language
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getByName(string $name): Language
    {
        return $this->createQueryBuilder('language')
            ->select('l')
            ->from($this->getEntityName(), 'l')
            ->where('l.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getSingleResult();
    }
}