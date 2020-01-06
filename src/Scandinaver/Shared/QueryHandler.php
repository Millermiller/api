<?php


namespace Scandinaver\Shared;

/**
 * Interface Handler
 * @package Scandinaver\Shared
 */
interface QueryHandler
{
    /**
     * @param Query $command
     */
    public function handle(Query $command);
}