<?php


namespace Scandinaver\Shared\Contract;

/**
 * Interface AggregateRoot
 *
 * @package Scandinaver\Shared\Contract
 */
interface AggregateRoot
{
    public function releaseEvents();
}