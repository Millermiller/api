<?php


namespace Scandinaver\Shared;

use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\OptimisticLockException;
use Psr\Log\LoggerInterface;
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
     */
    public function delete($object): void
    {
       // $this->_em->getConnection()->beginTransaction();

        try {
            $this->fireEvents($object);
            $this->_em->remove($object);
            $this->_em->flush($object);
         //   $this->_em->getConnection()->commit();
        } catch (\Exception $e) {
            /** @var LoggerInterface $logger */
            $logger = app('LoggerInterface');
            $logger->error($e->getMessage());
        }

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