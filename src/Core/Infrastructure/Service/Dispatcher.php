<?php


namespace Scandinaver\Core\Infrastructure\Service;

use Illuminate\Foundation\Events\Dispatchable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Scandinaver\Core\Domain\Contract\CrossDomainEvent;
use Scandinaver\Core\Domain\Contract\DispatcherInterface;

/**
 * Class Dispatcher
 *
 * @package Scandinaver\Shared
 */
class Dispatcher implements DispatcherInterface
{
    public function dispatch(CrossDomainEvent $event): void
    {
        event($event);
    }
}