<?php


namespace Scandinaver\Common\Infrastructure\Service;

use Illuminate\Contracts\Foundation\Application;
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

    /**
     * @return Container
     */
    public static function getInstance(): Container
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @param  string  $id
     *
     * @return Application|mixed|string
     */
    public function get($id)
    {
        return app($id);
    }

    /**
     * @param  string  $id
     *
     * @return bool|void
     */
    public function has($id)
    {
        // TODO: Implement has() method.
    }
}