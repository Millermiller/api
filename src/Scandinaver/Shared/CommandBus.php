<?php


namespace Scandinaver\Shared;

use ReflectionClass;
use ReflectionException;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\Shared\Contract\CommandHandler;

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
        return $this->resolveHandler($command)->handle($command);
    }

    public function resolveHandler(Command $command): ?CommandHandler
    {
        try {
            return app()->make($this->getHandlerClass($command));
        } catch (ReflectionException $e) {
            return null;
        }
    }

    /**
     * @throws ReflectionException
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