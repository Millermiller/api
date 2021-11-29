<?php


namespace Scandinaver\Core\Domain\Contract;

/**
 * Interface RedisInterface
 *
 * @package Scandinaver\Core\Domain\Contract
 */
interface RedisInterface
{

    /**
     * @param  string  $key
     * @param  string  $data
     *
     * @return mixed
     */
    public function set(string $key, string $data);

    /**
     * @param  string  $key
     * @param  string  $field
     * @param  string  $value
     *
     * @return mixed
     */
    public function hset(string $key, string $field, string $value);

    /**
     * @param  string  $key
     * @param  string  $field
     *
     * @return mixed
     */
    public function hdel(string $key, string $field);

    /**
     * @param  string  $key
     *
     * @return mixed
     */
    public function get(string $key);

    /**
     * @param  string  $key
     * @param  string  $field
     *
     * @return mixed
     */
    public function hget(string $key, string $field);

    public function keys();

    public function all();
}