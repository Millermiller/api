<?php


namespace Scandinaver\Shared\Contract;

/**
 * Interface CommandHandler
 *
 * @package Scandinaver\Shared\Contract
 */
interface CommandHandler
{

    /**
     * @param  \Scandinaver\Shared\Contract\Command  $command
     *
     * @return mixed
     */
    public function handle(Command $command);
}