<?php


namespace Scandinaver\Shared\Contract;


use Scandinaver\Shared\DomainEvent;
use Scandinaver\Shared\DomainEventHandler;

/**
 * Interface EventBusInterface
 *
 * @package Scandinaver\Shared\Contract
 */
interface EventBusInterface
{

    /**
     * @param  \Scandinaver\Shared\DomainEventHandler  $handler
     *
     * @return mixed
     */
    public function registerHandler(DomainEventHandler $handler);

    /**
     * @param  \Scandinaver\Shared\DomainEvent  $event
     *
     * @return mixed
     */
    public function dispatch(DomainEvent $event);
}