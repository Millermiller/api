<?php


namespace Scandinaver\Shared;

use Illuminate\Contracts\Container\BindingResolutionException;
use ReflectionClass;
use ReflectionException;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CommandBus
 *
 * @package Scandinaver\Shared
 */
class CommandBus
{
    /**
     * @param  CommandInterface  $command
     *
     * @return mixed
     */
    public function execute(CommandInterface $command)
    {
        $handler = $this->resolveHandler($command);
        $handler->handle($command);
        return $handler->processData();
    }

    public function resolveHandler(CommandInterface $command): ?AbstractHandler
    {
        try {
            return app()->make($this->getHandlerClass($command));
        } catch (ReflectionException | BindingResolutionException $e) {
            return NULL;
        }
    }

    /**
     * @param  CommandInterface  $command
     *
     * @return string
     */
    public function getHandlerClass(CommandInterface $command): string
    {
        $fullName = (new ReflectionClass($command))->getName();
        $parts = explode('\\', $fullName);

        $domain = $parts[1];
        $type = $parts[3];
        $commandClassName = end($parts);

        $handlerClassName = "{$commandClassName}Handler";

        return "Scandinaver\\$domain\Application\Handler\\$type\\$handlerClassName";
    }

}