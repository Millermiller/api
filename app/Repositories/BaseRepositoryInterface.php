<?php

namespace App\Repositories;

use Doctrine\Common\Persistence\ObjectRepository;

interface BaseRepositoryInterface extends ObjectRepository
{
    public function all();

    public function get($id);

    public function save(object $data);

    public function update(object $entity, array $data);

    public function delete($id);

}