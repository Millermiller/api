<?php


namespace App\Repositories;

use Doctrine\Common\Inflector\Inflector;
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
    public function save(object $object)
    {
        $this->_em->persist($object);
        $this->_em->flush($object);
        return $object;
    }

    /**
     * @param object $entity
     * @param array $data
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update($entity, array $data)
    {
        foreach ($data as $key => $value) {
            $key = Inflector::camelize($key);
            if (property_exists($entity, $key)) {
                $entity->{'set'.ucfirst($key)}($value);
            }
        }
        $this->_em->flush($entity);
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