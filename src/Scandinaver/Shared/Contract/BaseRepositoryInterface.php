<?php


namespace Scandinaver\Shared\Contract;

use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Interface BaseRepositoryInterface
 *
 * @package Scandinaver\Shared\Contract
 */
interface BaseRepositoryInterface extends ObjectRepository
{

    /**
     * @param  array  $criteria
     *
     * @return mixed
     */
    public function count(array $criteria);

    /**
     * @param  object  $data
     *
     * @return mixed
     */
    public function save(object $data);

    /**
     * @param  object  $entity
     * @param  array   $data
     *
     * @return mixed
     */
    public function update(object $entity, array $data);

    /**
     * @param $object
     *
     * @return mixed
     */
    public function delete($object);
}