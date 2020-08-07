<?php


namespace Scandinaver\Shared;

use ReflectionClass;
use ReflectionException;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\Shared\Contract\QueryHandler;
use Scandinaver\Shared\Contract\Response;

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
     * @return Response|null
     */
    public function execute(Query $command)
    {
        return $this->resolveHandler($command)->handle($command);
    }

    /**
     * @param  Query  $query
     *
     * @return QueryHandler
     */
    public function resolveHandler(Query $query): ?QueryHandler
    {
        try {
            return app()->make($this->getHandlerClass($query));
        } catch (ReflectionException $e) {
            return null;
        }
    }

    /**
     * @param  Query  $command
     *
     * @return string
     * @throws ReflectionException
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