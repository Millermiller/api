<?php


namespace App\Repositories;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;

class BaseRepository extends EntityRepository implements BaseRepositoryInterface
{
    /**
     * @return array
     */
    public function all()
    {
        return $this->findAll();
    }

    /**
     * @param $id
     * @return object|null
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param $object
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($object)
    {
        $this->_em->persist($object);
        $this->_em->flush($object);
        return $object;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $object
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($object)
    {
        $this->_em->remove($object);
        $this->_em->flush($object);
        return true;
    }
}