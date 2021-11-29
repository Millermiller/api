<?php


namespace Scandinaver\Core\Domain\Contract;

/**
 * Interface DispatcherInterface
 *
 * @package Scandinaver\Core\Domain\Contract
 */
interface DispatcherInterface
{

    public function dispatch(CrossDomainEvent $event): void;

}