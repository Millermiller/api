<?php

namespace App\Repositories\Intro;

use App\Repositories\BaseRepository;

class IntroRepository extends BaseRepository implements IntroRepositoryInterface
{
    /**
     * @return array
     */
    public function getGrouppedIntro()
    {
        $collection = [];

        $q = $this->_em->createQueryBuilder();

        $items =  $q->select('i')
            ->from($this->getEntityName(), 'i' )
            ->where('i.active = :active')
            ->setParameter('active', 1)
            ->orderBy('i.sort', 'asc')
            //->groupBy('i.page')
            ->getQuery()
            ->getResult();

        foreach ($items as $item){
            if(!isset($collection[$item->getPage()]))
                $collection[$item->getPage()] = [];

            array_push($collection[$item->getPage()], $item);
        }

        return $collection;
    }
}