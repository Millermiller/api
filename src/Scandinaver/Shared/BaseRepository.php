<?php


namespace Scandinaver\Shared;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Class BaseRepository
 *
 * @package Scandinaver\Shared
 */
class BaseRepository extends EntityRepository implements BaseRepositoryInterface
{

  //  use EventSourcingTrait;

    public function all(): array
    {
        return $this->findAll();
    }

    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(object $object)
    {
        $this->_em->persist($object);
        $this->_em->flush($object);

       // $this->fireEvents($object);

        return $object;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
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
      //  $this->fireEvents($entity);
        return $entity;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete($object): bool
    {
        $this->_em->remove($object);
        $this->_em->flush($object);
      //  $this->fireEvents($object);
    }
}