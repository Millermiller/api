<?php


namespace Scandinaver\Core\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\UnitOfWork;
use Psr\Log\LoggerInterface;
use Scandinaver\Core\Domain\AggregateRoot;
use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;
use Throwable;

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
        $entityState = $this->_em->getUnitOfWork()->getEntityState($object);
        $isNew = UnitOfWork::STATE_NEW === $entityState;

        if ($isNew) {
            $this->_em->persist($object);
        } else {
            // Assigning managed copy to argument.
            $object = $this->_em->merge($object);
        }

        $this->_em->flush();

        $this->fireEvents($object);

        return $object;
    }

    /**
     * @param  mixed|object  $entity
     * @param  array         $data
     *
     * @return mixed|object
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
     * @throws Throwable
     */
    public function delete($object): void
    {
       // $this->_em->getConnection()->beginTransaction();
        $object->onDelete();
        try {
            $this->fireEvents($object);
            $this->_em->remove($object);
            $this->_em->flush($object);
         //   $this->_em->getConnection()->commit();
        } catch (Throwable $e) {
            /** @var LoggerInterface $logger */
            $logger = app(LoggerInterface::class);
            $logger->error($e->getMessage());
            throw $e;
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