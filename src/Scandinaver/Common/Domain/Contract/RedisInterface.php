<?php


namespace Scandinaver\Common\Domain\Contract;

/**
 * Interface RedisInterface
 *
 * @package Scandinaver\Common\Domain\Contract
 */
interface RedisInterface
{
    public function set(string $key, string $data);

    public function hset(string $key, string $field, string $value);

    public function get(string $key);

    public function hget(string $key, string $field);

    public function keys();

    public function all();
}