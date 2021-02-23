<?php


namespace Scandinaver\Common\Infrastructure\Service;


use Scandinaver\Shared\Contract\EventBusInterface;
use Scandinaver\Shared\DomainEvent;
use Scandinaver\Shared\DomainEventHandler;

/**
 * Class LaravelEventBus
 *
 * @package Scandinaver\Common\Infrastructure\Service
 */
class LaravelEventBus implements EventBusInterface
{

    /**
     * @param  DomainEventHandler  $handler
     */
    public function registerHandler(DomainEventHandler $handler)
    {
        // TODO: Implement registerHandler() method.
    }

    /**
     * @param  DomainEvent  $event
     */
    public function dispatch(DomainEvent $event)
    {
        event($event);
    }
}