<?php


namespace Scandinaver\Shared;

use Illuminate\Contracts\Container\BindingResolutionException;
use ReflectionClass;
use ReflectionException;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\Shared\Contract\QueryHandler;

/**
 * Class CommandBus
 *
 * @package Scandinaver\Shared
 */
class QueryBus
{
    private const COMMAND_PREFIX = 'Query';

    private const HANDLER_PREFIX = 'Handler';

    /**
     * @param  Query  $command
     *
     * @return mixed
     */
    public function execute(Query $command)
    {
        $handler = $this->resolveHandler($command);
        $handler->handle($command);
        return $handler->processData();
    }

    /**
     * @param  Query  $query
     *
     * @return QueryHandler|null
     */
    public function resolveHandler(Query $query): ?AbstractHandler
    {
        try {
            return app()->make($this->getHandlerClass($query));
        } catch (ReflectionException | BindingResolutionException $e) {
            return NULL;
        }
    }

    /**
     * @param  Query  $command
     *
     * @return string
     */
    public function getHandlerClass(Query $command): string
    {
        return str_replace(
                self::COMMAND_PREFIX,
                self::HANDLER_PREFIX,
                (new ReflectionClass($command))->getShortName()
            ).'Interface';
    }
}