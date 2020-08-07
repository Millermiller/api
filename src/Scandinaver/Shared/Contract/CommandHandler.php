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
     * @param  Command  $command
     */
    public function handle(Command $command);

}