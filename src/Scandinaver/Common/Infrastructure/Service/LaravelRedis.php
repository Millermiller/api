<?php


namespace Scandinaver\Common\Infrastructure;

use Illuminate\Support\Facades\Redis;
use Scandinaver\Common\Domain\Contract\RedisInterface;

class LaravelRedis implements RedisInterface
{

    public function set(string $key, string $data)
    {
        Redis::connection()->set($key, $data);
    }

    public function get(string $key): ?string
    {
        return Redis::connection()->get($key);
    }

    public function hset(string $key, string $field, string $value)
    {
        Redis::connection()->hset($key, $field, $value);
    }

    public function hget(string $key, string $field): ?string
    {
        return Redis::connection()->hget($key, $field);
    }

    public function keys()
    {
        return Redis::connection()->keys('*');
    }

    public function all()
    {
        $result = [];

        $keys = $this->keys();

        foreach ($keys as $key) {
            $result[$key] = Redis::connection()->hgetall($key);
        }

        return $result;
    }
}