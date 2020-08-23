<?php


namespace Scandinaver\Shared\Contract;


use Scandinaver\Shared\DomainEvent;
use Scandinaver\Shared\DomainEventHandler;

interface EventBusInterface
{
    public function registerHandler(DomainEventHandler $handler);

    public function dispatch(DomainEvent $event);
}