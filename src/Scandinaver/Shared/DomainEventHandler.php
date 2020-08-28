<?php


namespace Scandinaver\Shared;

/**
 * Class DomainEventHandler
 *
 * @package Scandinaver\Shared
 */
abstract class DomainEventHandler
{
    abstract public function handle();
}