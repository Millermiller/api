<?php


namespace Scandinaver\Common\Infrastructure\Service;

use Psr\Container\ContainerInterface;

/**
 * Class Container
 *
 * @package Scandinaver\Common\Infrastructure\Service
 */
class Container implements ContainerInterface
{
    protected static ?Container $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function get($id)
    {
        return app($id);
    }

    public function has($id)
    {
        // TODO: Implement has() method.
    }
}