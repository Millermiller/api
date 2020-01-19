<?php

namespace Scandinaver\Common\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\{NoResultException, NonUniqueResultException};
use Scandinaver\Shared\BaseRepository;
use Scandinaver\Common\Domain\Contracts\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Language;

/**
 * Class LanguageRepository
 * @package Scandinaver\Common\Infrastructure\Persistence\Doctrine
 */
class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    /**
     * @param string $name
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