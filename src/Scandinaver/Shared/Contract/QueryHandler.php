<?php


namespace Scandinaver\Shared\Contract;

/**
 * Interface Handler
 *
 * @package Scandinaver\Shared\Contract
 */
interface QueryHandler
{
    public function handle(Query $command);
}