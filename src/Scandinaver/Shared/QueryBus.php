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

    public function execute(Query $command)
    {$v = $this->resolveHandler($command)->handle($command);
        return $this->resolveHandler($command)->handle($command);
    }

    public function resolveHandler(Query $query): ?QueryHandler
    {$c = $this->getHandlerClass($query);
        try {
            return app()->make($this->getHandlerClass($query));
        } catch (ReflectionException $e) {
            return $e->getMessage();
        }
    }

    /**
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