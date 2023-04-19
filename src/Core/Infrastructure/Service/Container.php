<?php


namespace Scandinaver\Core\Infrastructure\Service;

use Psr\Container\ContainerInterface;

/**
 * Class Container
 *
 * @package Scandinaver\Common\Infrastructure\Service
 */
class Container implements ContainerInterface
{
    protected static ?Container $instance = NULL;

    private function __construct()
    {
    }

    public static function getInstance(): Container
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @template T
     * @param  class-string<T>  $className
     *
     * @return T
     */
    public function get($className)
    {
        return app($className);
    }

    public function has(string $id): bool
    {
        // TODO: Implement has() method.
    }
}