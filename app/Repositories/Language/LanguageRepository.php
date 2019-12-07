<?php

namespace App\Repositories\Language;

use App\Entities\Language;
use App\Repositories\BaseRepository;

class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    /**
     * @param string $name
     * @return Language
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
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