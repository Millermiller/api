<?php


namespace Scandinaver\Shared;

use League\Fractal\Manager;
use League\Fractal\Resource\ResourceAbstract;
use Scandinaver\Common\Infrastructure\Service\Container;

/**
 * Class AbstractHandler
 *
 * @package Scandinaver\Shared
 */
abstract class AbstractHandler
{
    protected Manager $fractal;

    protected ResourceAbstract $resource;

    public function __construct()
    {
        $fractal = Container::getInstance()->get(Manager::class);
        $fractal->setSerializer(new NoDataKeySerializer());

        $this->fractal = $fractal;
    }

    /**
     * @param $command
     */
    public abstract function handle($command): void;

    public function processData(): array
    {
        return $this->fractal->createData($this->resource)->toArray();
    }
}