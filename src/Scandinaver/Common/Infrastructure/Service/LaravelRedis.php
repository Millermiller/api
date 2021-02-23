<?php


namespace Scandinaver\Common\Infrastructure\Service;

use Illuminate\Support\Facades\Redis;
use Scandinaver\Common\Domain\Contract\RedisInterface;

/**
 * Class LaravelRedis
 *
 * @package Scandinaver\Common\Infrastructure\Service
 */
class LaravelRedis implements RedisInterface
{

    /**
     * @param  string  $key
     * @param  string  $data
     */
    public function set(string $key, string $data)
    {
        Redis::connection()->set($key, $data);
    }

    public function get(string $key): ?string
    {
        return Redis::connection()->get($key);
    }

    /**
     * @param  string  $key
     * @param  string  $field
     * @param  string  $value
     */
    public function hset(string $key, string $field, string $value)
    {
        Redis::connection()->hset($key, $field, $value);
    }

    public function hget(string $key, string $field): ?string
    {
        return Redis::connection()->hget($key, $field);
    }

    /**
     * @return mixed
     */
    public function keys()
    {
        return Redis::connection()->keys('*');
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $result = [];

        $keys = $this->keys();

        foreach ($keys as $key) {
            $result[$key] = Redis::connection()->hgetall($key);
        }

        return $result;
    }
}