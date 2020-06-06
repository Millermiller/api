<?php


namespace Scandinaver\Shared;

use ReflectionClass;
use ReflectionException;
use Scandinaver\Shared\Contracts\Command;
use Scandinaver\Shared\Contracts\CommandHandler;

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
     * @param Command $command
     */
    public function execute(Command $command): void
    {
        $this->resolveHandler($command)->handle($command);
    }

    /**
     * @param Command $command
     *
     * @return CommandHandler
     */
    public function resolveHandler(Command $command): CommandHandler
    {
        try {
            return app()->make($this->getHandlerClass($command));
        }
        catch (ReflectionException $e) {
            return null;
        }
    }

    /**
     * @param Command $command
     *
     * @return string
     * @throws ReflectionException
     */
    public function getHandlerClass(Command $command): string
    {
        return str_replace(self::COMMAND_PREFIX, self::HANDLER_PREFIX, (new ReflectionClass($command))->getShortName()) . 'Interface';
    }
}