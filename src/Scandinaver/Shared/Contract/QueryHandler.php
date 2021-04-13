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
     * @param  Query  $query
     *
     * @return mixed
     */
    public function handle(Query $query);
}