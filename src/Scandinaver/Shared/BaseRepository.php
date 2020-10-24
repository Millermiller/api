<?php


namespace Scandinaver\Shared;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\UnitOfWork;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\Shared\Contract\EventBusInterface;

/**
 * Class BaseRepository
 *
 * @package Scandinaver\Shared
 */
class BaseRepository extends EntityRepository implements BaseRepositoryInterface
{

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
        $this->fireEvents($object);

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