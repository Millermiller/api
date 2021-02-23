<?php


namespace Scandinaver\Shared;

use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\OptimisticLockException;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Class BaseRepository
 *
 * @package Scandinaver\Shared
 */
class BaseRepository extends EntityRepository implements BaseRepositoryInterface
{

    /**
     * @param  object  $object
     *
     * @return object
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(object $object): object
    {
        $this->_em->persist($object);
        $this->_em->flush($object);
        $this->fireEvents($object);

        return $object;
    }

    /**
     * @param         $entity
     * @param  array  $data
     *
     * @return object
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update($entity, array $data): object
    {
        foreach ($data as $key => $value) {
            $key = Inflector::camelize($key);
            if (property_exists($entity, $key) && !is_array($value)) {
                $method = 'set'.ucfirst($key);
                if (method_exists($entity, $method)) {
                    $entity->{$method}($value);
                }
            }
        }
        $this->_em->flush($entity);
        $this->fireEvents($entity);

        return $entity;
    }

    /**
     * @param $object
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete($object): void
    {
        $this->_em->remove($object);
        $this->_em->flush($object);
        $this->fireEvents($object);
    }

    private function fireEvents(object $entity): void
    {
        if ($entity instanceof AggregateRoot) {
            $events = $entity->pullEvents();
            foreach ($events as $event) {
                $dispatcher = app('EventBusInterface');
                $dispatcher->dispatch($event);
            }
        }
    }
}