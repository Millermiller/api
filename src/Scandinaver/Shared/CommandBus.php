<?php


namespace Scandinaver\Shared;

use ReflectionException;

/**
 * Class CommandBus
 * @package Scandinaver\Shared
 */
class CommandBus
{
    private const COMMAND_PREFIX = 'Command';
    private const HANDLER_PREFIX = 'Handler';

    /**
     * @param Command $command
     * @throws ReflectionException
     */
    public function execute(Command $command): void
    {
        $this->resolveHandler($command)->handle($command);
    }

    /**
     * @param Command $command
     * @return CommandHandler
     * @throws ReflectionException
     */
    public function resolveHandler(Command $command): CommandHandler
    {
        return app()->make($this->getHandlerClass($command));
    }

    /**
     * @param Command $command
     * @return string
     * @throws ReflectionException
     */
    public function getHandlerClass(Command $command): string
    {
        return str_replace(self::COMMAND_PREFIX, self::HANDLER_PREFIX, (new \ReflectionClass($command))->getShortName()).'Interface';
    }
}