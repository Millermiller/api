<?php


namespace Scandinaver\Core\Domain\Contract\Repository;


use Doctrine\Persistence\ObjectRepository;

/**
 * Interface BaseRepositoryInterface
 *
 * @template T
 * @package Scandinaver\Core\Domain\Contract
 */
interface BaseRepositoryInterface extends ObjectRepository
{

    /**
     * @param  mixed  $id
     *
     * @return T|null
     */
    public function find($id, $lockMode = null, $lockVersion = null);

    /**
     * @return T[]
     */
    public function findAll();

    /**
     * Finds a single object by a set of criteria.
     *
     * @param  array  $criteria  The criteria.
     *
     * @return T|null The object.
     */
    public function findOneBy(array $criteria);

    /**
     * @param  array       $criteria
     * @param  array|null  $orderBy
     * @param  null        $limit
     * @param  null        $offset
     *
     * @return T[]
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param  array  $criteria
     *
     * @return mixed
     */
    public function count(array $criteria);

    /**
     * @param  object  $data
     *
     * @return T
     */
    public function save(object $data);

    /**
     * @param  T     $entity
     * @param  array $data
     *
     * @return T
     */
    public function update(object $entity, array $data);

    /**
     * @param $object
     *
     * @return mixed
     */
    public function delete($object);
}