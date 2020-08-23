<?php


namespace Scandinaver\Shared;


use Scandinaver\Shared\Contract\EventBusInterface;

class EventBus implements EventBusInterface
{

    public function registerHandler(DomainEventHandler $handler)
    {
        // TODO: Implement registerHandler() method.
    }

    public function dispatch(DomainEvent $event)
    {
        // TODO: Implement handle() method.
    }
}