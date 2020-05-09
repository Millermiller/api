<?php


namespace Scandinaver\Shared\Contracts;

/**
 * Interface QueryHandler
 *
 * @package Scandinaver\Shared\Contracts
 */
interface QueryHandler
{
    /**
     * @param Query $command
     */
    public function handle(Query $command);
}