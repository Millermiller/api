<?php


namespace Scandinaver\Core\Domain;

use League\Fractal\Manager;
use League\Fractal\Resource\ResourceAbstract;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;
use Scandinaver\Core\Infrastructure\Service\Container;
use Scandinaver\Core\Domain\Contract\CommandInterface;

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
        $fractal->setSerializer(new JsonApiSerializer());

        $this->fractal = $fractal;
    }

    public abstract function handle(CommandInterface $command): void;

    public function processData(): array
    {
        return $this->fractal->createData($this->resource)->toArray();
    }
}