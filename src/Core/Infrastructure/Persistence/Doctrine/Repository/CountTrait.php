<?php


namespace Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository;

use Scandinaver\Common\Domain\Entity\Language;

/**
 * Trait CountTrait
 *
 * @package Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository
 */
trait CountTrait
{

    /**
     * @param  Language  $language
     *
     * @return int
     */
    public function getCountByLanguage(Language $language): int
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('count(a.id)')
                 ->from($this->getEntityName(), 'a')
                 ->where($q->expr()->eq('a.language', ':language'))
                 ->setParameter('language', $language)
                 ->getQuery()
                 ->getSingleScalarResult();
    }
}