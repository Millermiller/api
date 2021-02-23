<?php


namespace Scandinaver\Shared;


use Scandinaver\Shared\Contract\EventBusInterface;

/**
 * Class EventBus
 *
 * @package Scandinaver\Shared
 */
class EventBus implements EventBusInterface
{

    /**
     * @param  DomainEventHandler  $handler
     *
     * @return mixed|void
     */
    public function registerHandler(DomainEventHandler $handler)
    {
        // TODO: Implement registerHandler() method.
    }

    /**
     * @param  DomainEvent  $event
     *
     * @return mixed|void
     */
    public function dispatch(DomainEvent $event)
    {
        // TODO: Implement handle() method.
    }
}