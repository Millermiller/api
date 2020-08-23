<?php


namespace Scandinaver\Shared;


abstract class DomainEventHandler
{
    abstract public function handle();
}