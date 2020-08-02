<?php


namespace Scandinaver\Shared\Contracts;


interface AggregateRoot
{
    public function releaseEvents();
}