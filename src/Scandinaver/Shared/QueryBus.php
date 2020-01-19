<?php


namespace Scandinaver\Shared;

use ReflectionException;
use Scandinaver\Shared\Contracts\Query;
use Scandinaver\Shared\Contracts\QueryHandler;
use Scandinaver\Shared\Contracts\Response;

/**
 * Class CommandBus
 * @package Scandinaver\Shared
 */
class QueryBus
{
    private const COMMAND_PREFIX = 'Query';
    private const HANDLER_PREFIX = 'Handler';

    /**
     * @param Query $command
     * @return Response|null
     * @throws ReflectionException
     */
    public function execute(Query $command)
    {
        return $this->resolveHandler($command)->handle($command);
    }

    /**
     * @param Query $command
     * @return QueryHandler
     * @throws ReflectionException
     */
    public function resolveHandler(Query $command): QueryHandler
    {
        return app()->make($this->getHandlerClass($command));
    }

    /**
     * @param Query $command
     * @return string
     * @throws ReflectionException
     */
    public function getHandlerClass(Query $command): string
    {
        return str_replace(self::COMMAND_PREFIX, self::HANDLER_PREFIX, (new \ReflectionClass($command))->getShortName()).'Interface';
    }
}