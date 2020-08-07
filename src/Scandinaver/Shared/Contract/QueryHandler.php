<?php


namespace Scandinaver\Shared\Contract;

/**
 * Interface Handler
 *
 * @package Scandinaver\Shared\Contract
 */
interface QueryHandler
{

    /**
     * @param  Query  $command
     */
    public function handle(Query $command);

}