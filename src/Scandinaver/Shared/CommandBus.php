<?php


namespace Scandinaver\Shared;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use ReflectionClass;
use ReflectionException;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CommandBus
 *
 * @package Scandinaver\Shared
 */
class CommandBus
{

    /**
     * @param  BaseCommandInterface  $command
     *
     * @return mixed
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function execute(BaseCommandInterface $command)
    {
        $handler = $this->resolveHandler($command);
        if ($handler === NULL) {
            throw new \Exception('Handler for ' . get_class($command) . '  not found');
        }
        $handler->handle($command);
        return $handler->processData();
    }

    /**
     * @param  BaseCommandInterface  $command
     *
     * @return AbstractHandler|null
     * @throws BindingResolutionException
     */
    public function resolveHandler(BaseCommandInterface $command): ?AbstractHandler
    {
        try {
            return app()->make($this->getHandlerClass($command));
        } catch (ReflectionException | BindingResolutionException $e) {
            app()->make('Psr\Log\LoggerInterface')->error($e->getMessage(), $e->getTrace());
            return NULL;
        }
    }

    /**
     * @param  BaseCommandInterface  $command
     *
     * @return string
     */
    public function getHandlerClass(BaseCommandInterface $command): string
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