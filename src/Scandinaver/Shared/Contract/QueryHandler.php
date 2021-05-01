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
     * @param  CommandInterface  $query
     *
     * @return mixed
     */
    public function handle(CommandInterface $query);
}