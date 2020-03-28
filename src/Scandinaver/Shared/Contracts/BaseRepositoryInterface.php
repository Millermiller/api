<?php


namespace Scandinaver\Shared\Contracts;

use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Interface BaseRepositoryInterface
 *
 * @package Scandinaver\Shared\Contracts
 */
interface BaseRepositoryInterface extends ObjectRepository
{
    public function all();

    public function get($id);

    public function save(object $data);

    public function update(object $entity, array $data);

    public function delete($object);

}