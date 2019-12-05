<?php


namespace App\Repositories;


interface BaseRepositoryInterface
{

    public function all();

    public function get($id);

    public function save(object $data);

    public function update($data, $id);

    public function delete($id);

}