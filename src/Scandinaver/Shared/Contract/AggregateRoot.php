<?php


namespace Scandinaver\Shared\Contract;


interface AggregateRoot
{

    public function releaseEvents();

}