<?php


namespace App\Repositories;


interface BaseRepositoryInterface
{
    public function all();

    public function get($id);

    public function save(object $data);

    public function update(object $entity, array $data);

    public function delete($id);

}