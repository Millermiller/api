<?php


namespace Scandinaver\Shared;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;

/**
 * Class BaseRepository
 *
 * @package Scandinaver\Shared
 */
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
     *
     * @return object|null
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param $object
     *
     * @return mixed
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(object $object)
    {
        $this->_em->persist($object);
        $this->_em->flush($object);
        return $object;
    }

    /**
     * @param object $entity
     * @param array  $data
     *
     * @return object
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update($entity, array $data)
    {
        foreach ($data as $key => $value) {
            $key = Inflector::camelize($key);
            if (property_exists($entity, $key)) {
                $entity->{'set' . ucfirst($key)}($value);
            }
        }
        $this->_em->flush($entity);
        return $entity;
    }

    /**
     * @param $object
     *
     * @return bool
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete($object)
    {
        $this->_em->remove($object);
        $this->_em->flush($object);
    }
}