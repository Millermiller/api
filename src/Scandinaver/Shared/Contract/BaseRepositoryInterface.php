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
    public function count(array $criteria);

    public function all();

    public function get($id);

    public function save(object $data);

    public function update(object $entity, array $data);

    public function delete($object);
}