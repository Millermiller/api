<?php


namespace Scandinaver\Shared;

use Illuminate\Contracts\Container\BindingResolutionException;
use ReflectionClass;
use ReflectionException;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CommandBus
 *
 * @package Scandinaver\Shared
 */
class CommandBus
{
    private const COMMAND_PREFIX = 'Command';

    private const HANDLER_PREFIX = 'Handler';

    /**
     * @param  Command  $command
     *
     * @return mixed
     */
    public function execute(Command $command)
    {
        $handler = $this->resolveHandler($command);
        $handler->handle($command);
        return $handler->processData();
    }

    public function resolveHandler(Command $command): ?AbstractHandler
    {
        try {
            return app()->make($this->getHandlerClass($command));
        } catch (ReflectionException | BindingResolutionException $e) {
            return NULL;
        }
    }

    /**
     * @param  Command  $command
     *
     * @return string
     */
    public function getHandlerClass(Command $command): string
    {
        return str_replace(
                self::COMMAND_PREFIX,
                self::HANDLER_PREFIX,
                (new ReflectionClass($command))->getShortName()
            ).'Interface';
    }

}