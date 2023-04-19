<?php


namespace Scandinaver\Core\Domain;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use ReflectionClass;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;
use Throwable;

/**
 * Class CommandBus
 *
 * @package Scandinaver\Core\Domain
 */
class CommandBus
{

    /**
     * @param  BaseCommandInterface  $command
     *
     * @return array
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function execute(BaseCommandInterface $command): array
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
            // $className = $this->getHandlerClass($command);
            $className = $this->getHandlerClassByAttribute($command);
            return app()->make($className);
        } catch (Throwable $e) {
            app()->make('Psr\Log\LoggerInterface')->error($e->getMessage(), $e->getTrace());
            return NULL;
        }
    }

    /**
     * @param  BaseCommandInterface  $command
     *
     * @return string
     */
    private function getHandlerClass(BaseCommandInterface $command): string
    {
        $fullName = (new ReflectionClass($command))->getName();
        $parts = explode('\\', $fullName);

        $commandClassName = end($parts);

        $handlerClassName = "{$commandClassName}Handler";

        preg_match('/^Scandinaver\\\\(.*)\\\\UI\\\\(.*)\\\\(.*)$/m', $fullName, $matches);
        $domain = $matches[1];
        $type = $matches[2];

        return "Scandinaver\\$domain\Application\Handler\\$type\\$handlerClassName";
    }

    /**
     * @param  BaseCommandInterface  $command
     *
     * @return string
     * @throws Exception
     */
    private function getHandlerClassByAttribute(BaseCommandInterface $command): string
    {
        $reflector = new \ReflectionClass($command);
        $attributes = $reflector->getAttributes(Handler::class);
        foreach ($attributes as $attribute) {
            /** @var Handler $handler */
            $handler = $attribute->newInstance();
            return $handler->handlerClass;
        }

        throw new Exception('Attribute is not set for class'. Handler::class);
    }
}