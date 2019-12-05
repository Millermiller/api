<?php


namespace App\Repositories\Text;

use App\Entities\Text;
use App\Entities\Language;
use App\Repositories\BaseRepository;

class TextRepository extends BaseRepository implements TextRepositoryInterface
{
    /**
     * @param Language $language
     * @return Text
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getFirstText(Language $language) : Text
    {
       return $this->createQueryBuilder('asset')
           ->select('a')
           ->from($this->getEntityName(), 'a')
           ->where('a.level = :level')
           ->andWhere('a.lang = :language')
           ->setParameter('level', 1)
           ->setParameter('language', $language->getName())
           ->getQuery()
           ->getSingleResult();
    }
}