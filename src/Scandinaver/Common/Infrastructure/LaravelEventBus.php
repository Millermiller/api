<?php


namespace Scandinaver\Common\Infrastructure;


use Scandinaver\Shared\Contract\EventBusInterface;
use Scandinaver\Shared\DomainEvent;
use Scandinaver\Shared\DomainEventHandler;

class LaravelEventBus implements EventBusInterface
{

    public function registerHandler(DomainEventHandler $handler)
    {
        // TODO: Implement registerHandler() method.
    }

    public function dispatch(DomainEvent $event)
    {
        event($event);
    }
}