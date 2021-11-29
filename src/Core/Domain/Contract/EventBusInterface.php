<?php


namespace Scandinaver\Core\Domain\Contract;

use Scandinaver\Core\Domain\Contract\DomainEvent;

/**
 * Interface EventBusInterface
 *
 * @package Scandinaver\Core\Domain\Contract
 */
interface EventBusInterface
{

    public function dispatch(DomainEvent $event): void;
}