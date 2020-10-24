<?php


namespace Scandinaver\Shared\Contract;


use Scandinaver\Shared\DomainEvent;

interface EventHandlerInterface
{
    public function handle();
}