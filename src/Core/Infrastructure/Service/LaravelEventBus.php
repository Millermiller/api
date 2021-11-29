<?php


namespace Scandinaver\Core\Infrastructure\Service;


use Scandinaver\Core\Domain\Contract\EventBusInterface;
use Scandinaver\Core\Domain\Contract\DomainEvent;

/**
 * Class LaravelEventBus
 *
 * @package Scandinaver\Core\Infrastructure\Service
 */
class LaravelEventBus implements EventBusInterface
{

    public function dispatch(DomainEvent $event): void
    {
        event($event);
    }
}